<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at','status'];

    //Constantes para el status de una orden
    CONST PENDING = 1; //Orden realizada y no pagada
    CONST RECEIVED = 2; //Orden pagada
    CONST SENT = 3; //Producto enviado
    CONST DELIVERED = 4; //Producto entregado
    CONST CANCELED = 5; //Orden pendiente que no se pago

    //N a 1 con paises
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    //N a 1 con estados
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    //N a 1 con usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
