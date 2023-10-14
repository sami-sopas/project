<?php

namespace App\Livewire;

use App\Models\Size;
use App\Models\Color;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateBagItemSize extends Component
{
    //Propiedad que recibimos en shopping-bag
    public $rowId;

    //Cantidad seleccionada
    public $qty;

    //Stock actual del producto
    public $stock;

    public function mount()
    {
        $item = Cart::get($this->rowId);

        $this->qty = $item->qty;

        //Recuperamos la informacion del color del item
        $color = Color::where('name',$item->options->color->name)->first();

        //Recuperar la talla
        $size = Size::where('name',$item->options->size)->first();

        //Calcular stock
        $this->stock = qty_available($item->id,$color->id,$size->id);
        
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;

        //Actualizar el cart por la nueva cantidad
        Cart::update($this->rowId,$this->qty);

        //LLamar a evento para el componente del carrito se renderize y no tener que actualizar la pagina
        $this->dispatch('render');
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;

        //Actualizar el cart por la nueva cantidad
        Cart::update($this->rowId,$this->qty);

        //LLamar a evento para el componente del carrito se renderize y no tener que actualizar la pagina
        $this->dispatch('render');
    }
    
    public function render()
    {
        return view('livewire.update-bag-item-size');
    }
}
