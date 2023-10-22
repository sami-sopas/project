<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Recibe la orden de la que se realizara el pago
    public function payment(Order $order)
    {
        return view('Orders.payment',compact('order'));
    }
}
