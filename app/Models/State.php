<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name','country_id'];

    //Relacion 1 a N Entre Pais y Ordnes (Una orden pertenece a un pais)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
