<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creamos 15 productos que tendran 3 imagenes por cada uno
        Product::factory(15)->create()->each(function(Product $product){
            Image::factory(3)->create([
                'imageable_id' => $product->id, //Asociar a id del registro
                'imageable_type' => Product::class, //Asociar a modelo
            ]);
        });
    }
}
