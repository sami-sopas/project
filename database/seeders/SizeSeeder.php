<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder; //Para consultas de las relaciones
use App\Models\Product;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Rescatar productos de la tabla subcategories donde
           tanto el color como el size es true
        */
        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('color',true)
                        ->where('size',true);
        })->get();

        $sizes = ['XS','S','M','L'];

        foreach($products as $product)
        {
            foreach($sizes as $size)
            {
                //Agrega registros a la tabla sizes relacionado con products
                $product->sizes()->create([
                    'name' => $size //guardar en el nombre talla S,M,XS etc...
                ]);
            }
        }
    }
}
