<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Builder; //Para consultas de las relaciones
use App\Models\Product;
use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Recuperar productos donde en la tabla subcategories
           la columna color sea true y la tabla size sea false
           las consultas que se haran, seran a una relacion, no a la tabla en si
        */

        //Este metodo permite realizar consultas a las relaciones del modelo Product
        //El primer parametro es el nombre de la relacion que queremos consultar
        //El segundo parametro es una funcion que recibe una instancia de ese modelo
        $products = Product::whereHas('subcategory', function(Builder $query){
            /* Traer productos donde la subcategoria de ese producto tiene
               asociado color a true y size a false  */
            $query->where('color',true)
                        ->where('size',false);
        })->get();

        foreach($products as $product)
        {
            //Con attach asociamos esos productos con los colores que creamos en el ColorSeeder
            $product->colors()->attach([
                //Le asignamos que a cada color, tendra 10 unidades: 10 rojos, 10 azules etc...
                1 => [
                    'quantity' => 10
                ],
                2 => [
                    'quantity' => 10
                ],
                3 => [
                    'quantity' => 10
                ],
                4 => [
                    'quantity' => 10
                ],
            ]);
        }
    }
}
