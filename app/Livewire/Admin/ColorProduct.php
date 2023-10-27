<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;

//Como tiene el mismo nombre, le damos un alias
use App\Models\ColorProduct as Pivot;

class ColorProduct extends Component
{
    public $product, $colors, $color_id, $quantity;

    //Propiedades que pertenecen a la tabla pivote
    public $pivot, $pivot_color_id, $pivot_quantity;

    //Para controlar al modal si esta abierto o no
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

        //Existe ese registo ya en la tabla intermedia?, Este filtro lo obtiene
        $pivot = Pivot::where('color_id',$this->color_id)
                        ->where('product_id',$this->product->id)
                        ->first();

        //Existe! Entonces lo actualizamos para que se siga acumulando
        if($pivot){
            $pivot->quantity = $pivot->quantity + $this->quantity;
            $pivot->save();
        }
        else{
            //No existe, entonces lo agregamos
            //Insertar registro en tabla intermedia (color-product)
            $this->product->colors()->attach([
                $this->color_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }


        $this->reset(['color_id','quantity']);

        $this->dispatch('saved');
        
        $this->product = $this->product->fresh();

    }

    //Actualizar colores en la tabla pivote
    public function update()
    {
        $this->pivot->color_id =  $this->pivot_color_id;
        $this->pivot->quantity =  $this->pivot_quantity;

        $this->pivot->save();

        //Refrescar producto (por si las dudan)
        $this->product = $this->product->fresh();

        //Cerrar modal despues de guardar registro
        $this->open = false;
    }

    //Se ejecuta esta opcion cuando damos click a editar, para abrir el modal
    //Recibe el ID del registro en la tabla intermedia
    public function edit(Pivot $pivot)
    {
        $this->open = true;

        //Recuperamos la informacion de la tabla intermedia
        $this->pivot = $pivot;
        $this->pivot_color_id = $pivot->color_id;
        $this->pivot_quantity = $pivot->quantity;
        
    }

    public function delete(Pivot $pivot)
    {
        //Eliminar de la bd
        $pivot->delete();

        //Actuaizar producto
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        //Rescatar productos de la tabla pivote (color-product)
        $product_colors = $this->product->colors;

        return view('livewire.admin.color-product',compact('product_colors'));
    }
}
