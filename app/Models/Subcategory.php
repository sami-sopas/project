<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;

    //Efecto contrario a filable
    //Especificamos los campos que no quermos que tenga asignacion masiva
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //Relacion de N a 1 entre Subcategorias y Categorias (Inversa de 1 a N)
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    //Relacion de 1 a N entre Subcategorias y productos
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
