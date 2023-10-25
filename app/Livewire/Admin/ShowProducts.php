<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ShowProducts extends Component
{
    public function render()
    {
        //Nose pq marca error, pero asi jala
        return view('livewire.admin.show-products')->layout('layouts.admin');
    }
}
