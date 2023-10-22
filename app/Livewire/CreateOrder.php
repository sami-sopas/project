<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

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
    public $shipping_cost = 0;

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

    //Para que al cambiar de tipo de envio, se reinicien los inputs
    public function updatedShippingType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'country_id',
                'state_id',
                'address',
                'reference',
            ]);
        }
    }

    //NO jalo una madre de alpine tons lo tuve q llamar a traves de otro metodo
    public function pickupStore()
    {
        $this->updatedShippingType(1);
    }

    public function sendHome()
    {
        $this->updatedShippingType(2);
    }

    //Cada que cambia el pais, aqui se actualizan los estados
    public function updatedCountryId($value)
    {
        //Recuperar el pais seleccionado
        $country = Country::find($value);

        //Obtenemos el costo por ese pais para mostrarlo en la vista
        $this->shipping_cost = $country->cost;

        $this->states = State::where('country_id',$value)->get();

    }

    //Funcion que se ejecuta al presionar el boton de Completar orden
    public function create_order()
    {

        //Esperar para q acabe la animacion del boton xd
        sleep(5);

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

        //Creando la orden
        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->shipping_type = $this->shipping_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();

        if($this->shipping_type == 2){
            $order->shipping_cost = $this->shipping_cost;
            $order->country_id = $this->country_id;
            $order->state_id = $this->state_id;
            $order->address = $this->address;
            $order->reference = $this->reference;
            
        }

        $order->save();

        //Una vez generada la orden, eliminamos los items del carrito
        Cart::destroy();

        return redirect()->route('orders.payment',$order);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
