<?php

namespace App\Livewire;

use Livewire\Component;

class AddBagItem extends Component
{
    //Cantidad de productos
    public $qty = 1;

    //Cantidad de stock
    public $stock;

    //Variable del producto, se recibe a traves de la vista de show
    public $product;

    public function mount()
    {
        //Recuperamos la cantidad de stock del producto
        $this->stock = $this->product->quantity;
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    public function render()
    {
        return view('livewire.add-bag-item');
    }
}
