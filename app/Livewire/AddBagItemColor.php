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

    //Constructor
    public function mount()
    {
        //Recuperar colores del producto actual
        $this->colors = $this->product->colors;

        //Como el primero es el seleccionado, tambien le rescatamos el stock
        $this->stock = $this->colors->first()->pivot->quantity;

        //Guardamos el color actual del primero 
        $this->actualColor = $this->colors->first();

        //Guardar la primera img para enviarla al carrito
        $this->url = Storage::url($this->product->images->first()->url);

    }

    public function updateStock($colorId)
    {
        //Color seleccionado
        $color = $this->product->colors->find($colorId);

        //Encontrar la cantidad, de acuerdo al color y tabla pivote
        $this->stock = $color->pivot->quantity;

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
        'options' => ['image' => $this->url, 'color' => $this->actualColor]
        ]);

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
