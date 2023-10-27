<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use App\Models\Size;
use Livewire\Component;

use App\Models\ColorSize as Pivot;

class ColorSize extends Component
{
    public $size,$colors, $color_id, $quantity;

    //Aqui se almacena el obj actual para editarlo y mostrar su info
    public $pivot, $pivot_color_id, $pivot_quantity;

    //Modal
    public $open = false;

    public $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount()
    {
        $this->colors = Color::all();
    }

    public function save()
    {
        $this->validate();

        //Agregar a tabla intermedia (color-size)
        $this->size->colors()->attach([
            $this->color_id => [
                'quantity' => $this->quantity
            ]
        ]);

        //Resetear color id  y cantidad
        $this->reset(['color_id','quantity']);

        //Generar evento para mensaje de guardado
        $this->dispatch('saved');

        //Refrescar talla
        $this->size = $this->size->fresh();
    }

    //Modal para Actualizar info
    public function edit(Pivot $pivot)
    {
        //abrir modal
        $this->open = true;

        //Mostrar modal con informacion del producto
        $this->pivot = $pivot;
        $this->pivot_color_id = $pivot->color_id;
        $this->pivot_quantity = $pivot->quantity;
    }

    public function update()
    {
        //Agarramos la informacion de los inputs
        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;

        //Guardamos en la BD
        $this->pivot->save();

        //Refrescar talla
        $this->size = $this->size->fresh();

        //Cerrar modal
        $this->reset('open');
    }

    public function render()
    {
        //Rescatar colores relacionadas a esa talla
        $size_colors = $this->size->colors;

        return view('livewire.admin.color-size',compact('size_colors'));
    }
}
