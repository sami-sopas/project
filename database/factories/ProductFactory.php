<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(2);

        //Recuperamos todos los registros de subcategorias para poder asociar el id a la FK subcategory
        $subcategory = Subcategory::all()->random();

        /* Si la subcategoria indica que ese producto tendra colores
           entonces no guardamos la cantidad de productos en la tabla products,
           la guardamos en la tabla color_product */
        if($subcategory->color){
            $quantity = null;
        }
        else{ //color es falso, entonces guardamos la cantidad en products
            $quantity = $this->faker->randomDigitNotNull();
        }

        return [
            'name' => $name,
            'slug'=> Str::slug($name),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement(['299.99','150.00','500.50']),
            'subcategory_id' => $subcategory->id,
            'quantity' =>  $quantity,
        ];
    }
}
