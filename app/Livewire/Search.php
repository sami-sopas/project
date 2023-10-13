<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

//Barra de busqueda dinamica
class Search extends Component
{
    public $search;

    //Para mantener el div cerrado de los resultados
    public $open = false;

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function render()
    {
        if($this->search){
            $products = Product::where('name','LIKE', "%" . $this->search . "%")
                                                                    ->take(6)
                                                                    ->get();
        }else{
            $products = [];
        }

        return view('livewire.search',compact('products'));
    }
}
