<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class DropdownBag extends Component
{
    
    //Esta propiedad escucha al evento que se llama desde AddBagItem
    #[On('render')]
    public function render()
    {
        return view('livewire.dropdown-bag');
    }
}
