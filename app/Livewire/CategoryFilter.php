<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination; //Paginacion dinamica

    public $category;

    public function render()
    {
        //Rescatar los productos correspondientes a esa categoria
        $products = $this->category->products()->paginate(18);

        return view('livewire.category-filter',compact('products'));
    }
}
