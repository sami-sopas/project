<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Habilitar asignacion masiva para los campos
    protected $fillable = [
        'name',
        'slug',
        'image',
        'icon'
    ];
}
