<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name','cost'];

    //Relacion 1 a N entre Pais y Estados
    public function states()
    {
        return $this->hasMany(State::class);
    }

    //Relacion 1 a N Entre Pais y Ordnes (Una orden pertenece a un pais)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
