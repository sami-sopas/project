<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;

//Para usar policies
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{
    //Autorizar policies
    use AuthorizesRequests;

    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    /* Se activa esta funcion cuando el pago se procesa,
       actualizamos el status de la orden */
    public function payOrder()
    {
        $this->order->status = 2;
        $this->order->save();

        return redirect()->route('orders.show',$this->order);
    }

    public function render()
    {
        //Utilizando OrderPolicy, para validar que sea su orden
        $this->authorize('author',$this->order);

        //Validar que sea suya y se prohibe si ya se pago la orden
        $this->authorize('payment',$this->order);

        $items = json_decode($this->order->content);

        return view('livewire.payment-order',compact('items'));
    }
}
