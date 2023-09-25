<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class NavBar extends Component
{
    public function render()
    {
        //rescatar categorias
        $categories = Category::all();

        return view('livewire.nav-bar',compact('categories'));
    }
}
