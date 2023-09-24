<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    //Evitar asignacion masiva en...
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //Relacion 1 a N inversa entre Product y Subcategory
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    //Relacion 1 a N entre Products y Sizes
    public function sizes(): HasMany 
    {
        return $this->hasMany(Size::class);
    }

    //Relacion N a N entre Products y Colors. Los colores que le perteneces a un product
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    //Relacion polimorfica
    public function images() : MorphMany
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
