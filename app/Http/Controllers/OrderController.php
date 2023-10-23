<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Recibe la orden de la que se realizara el pago
    public function payment(Order $order)
    {
        //Quitarle el json al contenido para poder iterarlo
        $items = json_decode($order->content);

        return view('Orders.payment',compact('order','items'));
    }

    public function show(Order $order)
    {
        return view('Orders.show',compact('order'));
    }
}
