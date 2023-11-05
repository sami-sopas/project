<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class StatusOrder extends Component
{
    public $order; //la que recibimos por medio de la vista show

    public $status; //lo que guarde en el input

    public function mount()
    {
        $this->status = $this->order->status;
    }

    //Form que se vincula en la vista
    public function update()
    {
        
        $this->order->status = $this->status;

        //Actualizar en bd
        $this->order->save();
    }

    public function render()
    {
        //Recuperar lo que se pidio en esa orden
        $items = json_decode($this->order->content);

        return view('livewire.status-order',compact('items'));
    }
}
