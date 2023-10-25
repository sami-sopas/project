<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

class CreateProduct extends Component
{
    public $categories, $subcategories = [];

    //Datos seleccionados
    public $category_id = "", $subcategory_id = "";

    //Cada que se actualize la categoria, actualizamos sus subcategorias
    public function updateCategoryId($value)
    {
        $this->subcategories = Subcategory::where('category_id',$value)->get();

        //Si se selecciona otra categoria, reseteamos las subcategorias
        $this->reset('subcategory_id');
    }

    //Al tener seleccionada una categoria, y seleccionar una sub, se actualiza su id
    public function updateSubcategoryId($value)
    {
    $this->subcategory_id = $value;
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
