<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    //Policy para determinar si la orden pertenece al usuario autenticado
    public function author(User $user, Order $order)
    {
        if($order->user_id == $user->id){
            return true;
        }
        else{
            //Al retornar false, da error 403
            return false;
        }

    }

    //Para que no pueda acceder a la vista de pago (una vez pagado)
    public function payment(User $user, Order $order)
    {
        //No dejar acceder si no es su orden Y si ya fue pagada
        if ($user->id == $order->user_id && $order->status == Order::PENDING) {
            return true;
          } else {
            return false;
          }
    }
}
