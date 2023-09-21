<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    //Relacion 1 a N entre Categoria y Subcategorias
    public function subcategories() : HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    //Relacion 1 a N a traves de la tabla subcategory
    /*
        Category
            id
            name
        SubCategory
            id
            name
        Products
            id
            name

        Se conecta product con category a traves de subcategory
    */
    public function products() : HasManyThrough
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }
}
