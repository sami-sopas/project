<?php

namespace App\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;

class SizeProduct extends Component
{
    public $product, $name, $size;

    //Mantener modal cerrado
    public $open = false;

    //Se almacena temporalmente el nombre de la variable a editar
    public $name_edit;

    protected $rules = [
        'name' => 'required'
    ];

    public function save(){

        $this->validate();

        //Validacion para que no se suban tallas repetidas
        $size = Size::where('product_id',$this->product->id)
                        ->where('name',$this->name)
                        ->first();

        if($size){
            $this->dispatch('errorSize','Esa talla ya existe !');
        }
        else{
            //Talla no existe, se agrega...
            //Recuperar tallas del producto, y en la tabla sizes, agregar la nueva talla
            $this->product->sizes()->create([
                'name' => $this->name
            ]);
        }


        //Resetear campo
        $this->reset('name');

        //Refrescar producto
        $this->product = $this->product->fresh();
    }

    //Mostrar modal para editar
    public function edit(Size $size)
    {
        $this->open = true;

        //Almacenar el objeto que quiero editar
        $this->size = $size;

        //Guardamos el nombre de la talla actual para mostrarla en el modal
        $this->name_edit = $size->name;
    }

    //Actualizar en BD
    public function update()
    {
        $this->validate([
            'name_edit' => 'required'
        ]);

        //Modificar nombre de la talla
        $this->size->name = $this->name_edit;
        $this->size->save();

        //Actualizar producto
        $this->product = $this->product->fresh();

        //Cerrar modal
        $this->open = false;
    }

    //Eliminar talla, recibe el Id de la talla a eliminar
    public function delete(Size $size)
    {
        $size->delete();

        $this->product = $this->product->fresh();
    }

    public function render()
    {
        //Recuperar tallas relacionadas al producto actual
        $sizes = $this->product->sizes;

        return view('livewire.admin.size-product',compact('sizes'));
    }

}
