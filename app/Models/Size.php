<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id'
    ];

    //Relacion 1 a N inversa entre SIzes y Product
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    //Relacion N a N entre Sizes y Colors
    public function colors() : BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }
}
