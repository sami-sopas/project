<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

use App\Models\Subcategory;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
    public $categories, $subcategories = [];

    //Datos seleccionados
    public $category_id = "", $subcategory_id = "";
    
    public $name, $slug, $description, $price, $quantity;

    //Validaciones
    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        'price' => 'required'
    ];

    //Cada que se actualize la categoria, actualizamos sus subcategorias
    public function updatedCategoryId($value)
    {
        $this->subcategories = Subcategory::where('category_id',$value)->get();

        //Si se selecciona otra categoria, reseteamos las subcategorias
        $this->reset('subcategory_id');
    }

    //Propiedad computada para saber si la subcategoria tiene color o size
    public function getSubcategoryProperty(){
        //Encontrar subcategoria seleccionada
        return Subcategory::find($this->subcategory_id);
    }

    //Queda a la escucha cuando cambie la propiedad name
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    //Guardar en la BD
    public function save()
    {
        //Agregar rules dependiendo si tiene color o size
        $rules = $this->rules;

        //Mostrar errores en caso de mostrar los inputs especiales
        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){
                $rules['quantity'] = 'required';
            }
        }

        $this->validate($rules);

        //Post validate
        $product = new Product();

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->subcategory_id = $this->subcategory_id;
        $product->price = $this->price;
        
        //Producto sin color y talla? aqui se agarra su cantidad
        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){
                $product->quantity = $this->quantity;
            }
        }

        $product->save();

        return redirect()->route('admin.index');
 
    }

    public function render()
    {
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
