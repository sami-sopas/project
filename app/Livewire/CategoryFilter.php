<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    use WithPagination; //Paginacion dinamica

    public $category, $subcategoria;

    public function render()
    {
        /*Rescatar los productos correspondientes a esa categoria
        $products = $this->category->products()->paginate(18); */

        //Recuperar la relacion de productos y categorias a traves de la tabla subcategoria
        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            //Traer los productos de las subcategorias que coincidan con la que tenemos almacenada
            $query->where('id', $this->category->id);
        }); //Esto es solo una consulta!

        //Este filtro solo se aplica, si tenemos algo en la variable de subcategoria
        if($this->subcategoria) {
            //Hacemos que esa consulta, ahora filtre por la relacion de subcategoria
            //Para traernos a los productos que pertenezcan a esa subcategoria
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query) {
                $query->where('name',$this->subcategoria);
            });            
        }
        
        //Aqui ya tenemos la coleccion de registros
        $products = $productsQuery->paginate(18);

        return view('livewire.category-filter',compact('products'));
    }

    //Resetear los valores al dar click a boton de eliminar filtos
    public function clean()
    {
        $this->reset(['subcategoria']);
    }
}
