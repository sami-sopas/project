<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillabel = [
        'url',
        'imageable_id',
        'imageable_type',
    ];

    //Relacion 1 a N poliformica
    public function imageable() : MorphTo
    {
        return $this->morpTo();
    }
}
