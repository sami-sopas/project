<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // AHORA ESTA FUNCION LA HACE EL PaymentOrder
    // Recibe la orden de la que se realizara el pago
    // public function payment(Order $order)
    // {
    //     //Quitarle el json al contenido para poder iterarlo
    //     $items = json_decode($order->content);

    //     return view('Orders.payment',compact('order','items'));
    // }

    public function show(Order $order)
    {
        //Obtener los items de esa orden
        $items = json_decode($order->content);

        return view('Orders.show',compact('order','items'));
    }
}
