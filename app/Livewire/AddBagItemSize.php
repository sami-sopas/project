<?php

namespace App\Livewire;

use App\Models\Size;
use Livewire\Component;

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

    public function mount()
    {
        $this->sizes = $this->product->sizes;

        if ($this->sizes->isNotEmpty()) {
            $size = $this->sizes->first(); // Obtén la primera talla disponible (puedes ajustar esto según tus necesidades)
            $this->size_id = $size->id;
            $this->colors = $size->colors;
            $this->stock = $this->colors->first()->pivot->quantity;
        }

    }

    public function updateStock($colorId)
    {
        //Talla seleccionado
        $size = Size::find($this->size_id);

        //Encontrar la cantidad, de acuerdo al color y tabla pivote
        $this->stock = $size->colors->find($colorId)->pivot->quantity;
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
    }



    public function render()
    {
        return view('livewire.add-bag-item-size', [
            'colors' => $this->product->colors,
        ]);
    }
}