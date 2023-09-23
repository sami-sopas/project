<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Esto crea la imagen y guarda la direccion de donde se descargo
        return [
            //Definiendo la ruta donde se guardan las imagenes, ancho, alto, /image.jpg
            'image' => 'subcategories/' . $this->faker->image('public/storage/subcategories',640,480,null,false),
        ];
    }
}
