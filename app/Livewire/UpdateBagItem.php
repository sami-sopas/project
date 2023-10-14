<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateBagItem extends Component
{
    //Propiedad que recibimos en shopping-bag
    public $rowId;

    //Cantidad seleccionada
    public $qty;

    //Stock actual del producto
    public $stock;

    public function mount()
    {
        //Obtenemos el item actual
        $item = Cart::get($this->rowId);

        //Obtenemos la cantidad de items
        $this->qty = $item->qty;

        //Obtenemos el Stock actual disponible producto
        $this->stock = qty_available($item->id) + $this->qty;
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
        return view('livewire.update-bag-item');
    }
}
