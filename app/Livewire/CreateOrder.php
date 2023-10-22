<?php

namespace App\Livewire;

use App\Models\State;
use App\Models\Country;
use Livewire\Component;

class CreateOrder extends Component
{
    //Para sincronizar alpine con livewire (cambiara dependiendo del input seleccionado)
    public $shipping_type = 1;

    //Guardar paises y estados
    public $countries;
    public $states = []; //Lo inicialicamos en un array porque dependera del pais los estados a mostrar

    //Guardar el id del pais y estado seleccionado (para vinculador con wire:model)
    public $country_id = "";
    public $state_id = "";

    //Para sincronizar esto con los inputs
    public $contact;
    public $phone;
    public $address;
    public $reference;

    //Validacion para todos
    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'shipping_type' => 'required'
    ];

    public function mount()
    {
        $this->countries = Country::all();
    }

    //Funcion que se ejecuta al presionar el boton de Completar orden
    public function create_order()
    {

        $rules = $this->rules;

        //En caso de elegir envio a domicilio,
        // agregaremos unas validaciones extra
        if($this->shipping_type == 2){
            $rules['country_id'] = 'required';
            $rules['state_id'] = 'required';
            $rules['address'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
