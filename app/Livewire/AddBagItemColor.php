<?php

namespace App\Livewire;

use Livewire\Component;

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

    //Constructor
    public function mount()
    {
        //Recuperar colores del producto actual
        $this->colors = $this->product->colors;

        //Como el primero es el seleccionado, tambien le rescatamos el stock
        $this->stock = $this->colors->first()->pivot->quantity;

    }

    public function updateStock($colorId)
    {
        //Color seleccionado
        $color = $this->product->colors->find($colorId);

        //Encontrar la cantidad, de acuerdo al color y tabla pivote
        $this->stock = $color->pivot->quantity;
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
        return view('livewire.add-bag-item-color', [
            'colors' => $this->product->colors,
        ]);
    }
}
