<?php

namespace App\Livewire;

use App\Models\Size;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddBagItemSize extends Component
{
    //Almacenar tallas relacionadas al producto
    public $sizes;

    //Poducto actual (se envia desde Product/show)
    public $product;

    //Para controlar la opcion seleccionada
    public $size_id = "";

    //Colores del producto con la talla actual
    public $colors;

    //(lo que me traje de AddBagItemColor aca)
    //Cantidad de productos
    public $qty = 1;

    //Stock (lo dejamos en 0 hasta que seleccione un color)
    public $stock;

    //Guardar el path de la img
    public $url;

    //Talla y color actual
    public $actualSize;
    public $actualColor;

    public function mount()
    {
        $this->sizes = $this->product->sizes;

        if ($this->sizes->isNotEmpty()) {
            $size = $this->sizes->first(); // Obtén la primera talla disponible (puedes ajustar esto según tus necesidades)
            $this->size_id = $size->id;
            $this->colors = $size->colors;
            //$this->stock = $this->colors->first()->pivot->quantity;
            
            $this->actualColor = $size->colors->first();
            $this->actualSize = $size;
            
            $this->stock = qty_available($this->product->id,$this->actualColor,$this->actualSize);
        }

        //Guardar la primera img para enviarla al carrito
        $this->url = Storage::url($this->product->images->first()->url);

    }

    public function updateStock($colorId)
    {
        //Talla seleccionado
        $size = Size::find($this->size_id);

        //Color actual de la talla actual
        $this->actualColor = $size->colors->find($colorId);

        //Encontrar la cantidad, de acuerdo al color y tabla pivote
        $this->stock = qty_available($this->product->id,$size->id,$this->actualColor);
        
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    //Funcion que se ejecuta cuando cambia el size_id
    public function updatedSizeId($value)
    {
        
        //Guardar el registro de la talla seleccionada
        $size = Size::find($value);

        //Recuperar los colores correspondientes a esa talla
        $this->colors = $size->colors;

        //Tamaño seleccionado, se envia al cart
        $this->actualSize = $size->name;
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
             'size' => $this->actualSize]
        ]);

        $this->stock = qty_available($this->product->id,$this->actualColor,$this->actualSize);

        //Resetear el input counter, a 1 para que no se quede ahi en 5 cuando se agregue al carro
        $this->reset('qty');

        //LLamar a evento para el componente del carrito se renderize y no tener que actualizar la pagina
        $this->dispatch('render');
    }



    public function render()
    {
        return view('livewire.add-bag-item-size', [
            'colors' => $this->product->colors,
        ]);
    }
}