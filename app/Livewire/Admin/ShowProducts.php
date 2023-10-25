<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search = '';

    //Cada que se modifique search, reseteamos el page?=1
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        //Recuperar productos
        $products = Product::where('name','LIKE', '%' . $this->search . '%')->paginate(10);

        //Nose pq marca error, pero asi jala
        return view('livewire.admin.show-products',compact('products'))->layout('layouts.admin');
    }
}
