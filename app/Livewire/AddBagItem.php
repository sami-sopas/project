<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddBagItem extends Component
{
    public $url;

    //Cantidad de productos
    public $qty = 1;

    //Cantidad de stock
    public $stock;

    //Variable del producto, se recibe a traves de la vista de show
    public $product;

    //Para la funcion del qty_add
    public $colorId = null;
    public $sizeId = null;

    public function mount()
    {
        //Recuperamos la cantidad disponible del producto usando el helper
        $this->stock = qty_available($this->product->id);

        $this->url = Storage::url($this->product->images->first()->url);
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
            'color_id' => $this->colorId,
            'size_id' => $this->sizeId]
        ]);

        $this->stock = qty_available($this->product->id);

        //Resetear el input counter, a 1 para que no se quede ahi en 5 cuando se agregue al carro
        $this->reset('qty');

        //LLamar a evento para el componente del carrito se renderize y no tener que actualizar la pagina
        $this->dispatch('render');
    }

    public function render()
    {
        return view('livewire.add-bag-item');
    }
}
