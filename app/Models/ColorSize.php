<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    //Tabla que administra este modelo
    protected $table = "color_size";

    //Relacion 1:N inversa
    public function color(){
        return $this->belongsTo(Color::class);
    }
    
    //Relacion 1:N inversa
    public function size(){
        return $this->belongsTo(Size::class);
    }
}
