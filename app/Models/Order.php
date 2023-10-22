<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //Constantes para el status de una orden
    CONST PENDING = 1; //Orden realizada y no pagada
    CONST RECEIVED = 2; //Orden pagada
    CONST SENT = 3; //Producto enviado
    CONST DELIVERED = 4; //Producto entregado
    CONST CANCELED = 5; //Orden pendiente que no se pago

}
