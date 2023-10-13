<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddBagItemColor extends Component
{

    //Informacion del producto que se envia por el show
    public $product;

    //Colores que tiene el producto
    public $colors;

    //Cantidad de productos
    public $qty = 1;

    //Stock (lo dejamos en 0 hasta que seleccione un color)
    public $stock;

    //Guardar la primera img del producto
    public $url;

    //Guardar color seleccionado
    public $actualColor;

    //Para lo del qtyadd
    public $sizeId = null;

    //Constructor
    public function mount()
    {
        //Recuperar colores del producto actual
        $this->colors = $this->product->colors;

        //Guardamos el color actual del primero 
        $this->actualColor = $this->colors->first();

        //Como el primero es el seleccionado, tambien le rescatamos el stock
        $this->stock = qty_available($this->product->id,$this->actualColor->id);


        //Guardar la primera img para enviarla al carrito
        $this->url = Storage::url($this->product->images->first()->url);

    }

    public function updateStock($colorId)
    {
        //Color seleccionado
        $color = $this->product->colors->find($colorId);

        //Encontrar la cantidad, de acuerdo al color y calculamos lo disponible
        $this->stock = qty_available($this->product->id,$color->id);

        $this->actualColor = $color;
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    public function addItem()
    {
        Cart::add([
        'id' => $this->product->id,
        'name' => $this->product->name,
        'qty' => $this->qty,
        'price' => $this->product->price,
        'options' => [
            'image' => $this->url,
            'color' => $this->actualColor,
            'size_id' => $this->sizeId,
            'color_id' => $this->actualColor->id,
            ]
        ]);

        $this->stock = qty_available($this->product->id,$this->actualColor->id);

        //Resetear el input counter, a 1 para que no se quede ahi en 5 cuando se agregue al carro
        $this->reset('qty');

        //LLamar a evento para el componente del carrito se renderize y no tener que actualizar la pagina
        $this->dispatch('render');
    }

    public function render()
    {
        return view('livewire.add-bag-item-color', [
            'colors' => $this->product->colors,
        ]);
    }
}
