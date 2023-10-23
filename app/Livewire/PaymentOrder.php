<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;

class PaymentOrder extends Component
{
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
        $items = json_decode($this->order->content);

        return view('livewire.payment-order',compact('items'));
    }
}
