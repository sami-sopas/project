<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditProduct extends Component
{
    public $categories, $subcategories, $category_id, $subcategory_id, $subcategory;
    public Product $product;
    //Propiedades del product, ya que no funciono el product.name etc
    public $name, $slug, $description, $price, $quantity;
    
    //Validaciones
     protected $rules = [
         'category_id' => 'required',
         'subcategory_id' => 'required',
         'name' => 'required',
         //'slug' => 'required|unique:products',
         'description' => 'required',
         'price' => 'required',
         'quantity' => 'numeric'
     ];

    public function mount(Product $product)
    {
        $this->product = $product;

        $this->categories = Category::all();

        $this->category_id = $product->subcategory->category->id;

        //Rescatar subcategorias pertenecientes a la categoria seleccionada
        $this->subcategories = Subcategory::where('category_id',$this->category_id)->get();

        $this->subcategory_id = $product->subcategory_id;

        //Asignar la subcategoría actualmente seleccionada a la propiedad $subcategory
        $this->subcategory = Subcategory::find($this->subcategory_id);

        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
    }

    public function updatedCategoryId($value)
    {
        $this->subcategories = Subcategory::where('category_id',$value)->get();

        //Si se selecciona otra categoria, reseteamos las subcategorias
        $this->subcategory_id = '';
        $this->reset('subcategory');

    }

    //Actualizar subcategoria, al seleccionar otra
    public function updatedSubcategoryId($value)
    {
        $this->subcategory = Subcategory::find($value);
    }

    //Propiedad computada
    // public function getSubcategoryProperty(){

    //     return Subcategory::find($this->subcategory_id);
    // }

        //Queda a la escucha cuando cambie la propiedad name
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $rules = $this->rules;

        //$rules['slug'] = 'required|unique:products,slug';

        //Evaluar si tenemos algo en el campo color o size
        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){
                $rules['quantity'] = 'required|numeric';
            }
        }

        //$this->validate($rules);
        
    
        //Actualizar registro
        $this->product->update([
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity
        ]);


        //Emitir evento
        $this->dispatch('saved');
        
        //Actualizar variable producto
        $this->product = $this->product->fresh();

    }

    public function deleteImage(Image $image)
    {
        //Eliminar imagen del servidor
        Storage::delete([$image->url]);

        //Eliminar de la BD
        $image->delete();

        //Actualizar producto
        $this->product = $this->product->fresh();
    }


    //Refrescar productos, para que vuelva a cargar
    public function refreshProduct()
    {
        $this->product = $this->product->fresh();
    }

    /*Metodo que se dispara al eliminar un Color de una talla,
      este se ejecuta desde el sweetAlert del editProduct y se envia a traves
      del boton eliminar del componente ColorSize, de aqui se manda al metodo delete
      a donde realmente pertenece pero que no pude enviar desde el script de JS */
     public function deleteColorSize($pivot)
     {
        $this->dispatch('delete', pivot: $pivot)->to(ColorSize::class);
     }

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }
}