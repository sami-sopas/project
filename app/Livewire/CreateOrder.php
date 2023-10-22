<?php

namespace App\Livewire;

use App\Models\State;
use App\Models\Country;
use Livewire\Component;

class CreateOrder extends Component
{
    //Guardar paises y estados
    public $countries;
    public $states = []; //Lo inicialicamos en un array porque dependera del pais los estados a mostrar

    //Guardar el id del pais y estado seleccionado (para vinculador con wire:model)
    public $country_id = "";
    public $state_id = "";

    public $address;
    public $reference;

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
