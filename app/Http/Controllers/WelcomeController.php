<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        if(auth()->user())
        {
            //Para cuando el usuario tenga pedidos pendientes y aun no pague
            $pending = Order::where('status',1)->where('user_id',auth()->user()->id)->count();

            if($pending){

                $msj = "CACAHUATES! Tienes $pending pedidos sin pagar. <a class='font-bold inline-block underline' href='". route('orders.index') . "?status=1'>Ir a pagar</a>"; 

                session()->flash('flash.banner',$msj);   
            }
        }


        return view('welcome');
    }
}
