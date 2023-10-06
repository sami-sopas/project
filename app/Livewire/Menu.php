<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Menu extends Component
{
    public function render()
    {

        $categories = Category::all();

        return view('livewire.menu',compact('categories'));
    }
}
