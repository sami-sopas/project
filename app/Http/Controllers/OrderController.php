<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        //Rescatar ordenes del usuario
        //$orders = Order::where('user_id',auth()->user()->id)->get();

        //query dinamica, depende de lo que se envie por la URL
        $orders = Order::query()->where('user_id',auth()->user()->id);

        //Filtro
        if(request('status')){
            $orders->where('status',request('status'));
        }

        //Generar la coleccion
        $orders = $orders->get();

        //Variables para mostrar los contadores de ordenes que pertenecen al usuario
        $pending = Order::where('status',1)->where('user_id',auth()->user()->id)->count();
        $received = Order::where('status',2)->where('user_id',auth()->user()->id)->count();
        $sent = Order::where('status',3)->where('user_id',auth()->user()->id)->count();
        $delivered = Order::where('status',4)->where('user_id',auth()->user()->id)->count();
        $canceled = Order::where('status',5)->where('user_id',auth()->user()->id)->count();

        return view('Orders.index',compact(
                                    'orders',
                                    'pending',
                                    'received',
                                    'sent',
                                    'delivered',
                                    'canceled'
                                    ));
    }

    public function show(Order $order)
    {
        //Validamos utilizando la OrderPolicy, para que acceda a su orden
        $this->authorize('author',$order);

        //Obtener los items de esa orden
        $items = json_decode($order->content);

        return view('Orders.show',compact('order','items'));
    }
}
