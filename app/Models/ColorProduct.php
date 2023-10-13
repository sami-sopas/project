<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    //Tabla que administra este modelo
    protected $table = "color_product";

    //Relacion 1:N inversa
    public function color(){
        return $this->belongsTo(Color::class);
    }

    //Relacion 1:N inversa
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
