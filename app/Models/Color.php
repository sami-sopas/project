<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;

        //Habilitar asignacion masiva
        protected $fillable = [
            'name'
        ];

        //Relacion N a N entre Colors y Products
        public function products() : BelongsToMany
        {
            return $this->belongsToMany(Product::class);
        }

        //Relacion N a N entre Colors y Sizes
        public function sizes() : BelongsToMany
        {
            return $this->belongsToMany(Size::class);
        }
}
