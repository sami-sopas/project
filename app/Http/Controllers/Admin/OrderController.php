<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        //query dinamica, depende de lo que se envie por la URL
        $orders = Order::query();

        //Filtro
        if(request('status')){
            $orders->where('status',request('status'));
        }

        //Generar la coleccion
        $orders = $orders->get();

        $pending = Order::where('status',1)->count();
        $received = Order::where('status',2)->count();
        $sent = Order::where('status',3)->count();
        $delivered = Order::where('status',4)->count();
        $canceled = Order::where('status',5)->count();

        return view('admin.orders.index',compact(
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
        return view('admin.orders.show');
    }
}

