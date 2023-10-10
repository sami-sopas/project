<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Recuperar todas las tallas
        $sizes = Size::all();

        //Asociar todas las tallas a todos los colores existentes
        
        foreach($sizes as $size){
            //Recuperamos la relacion de talla con colores y con attach los ponga en la tabla intermedia, vinculandolo a su ID
            $size->colors()
                    ->attach([ //En la relacion color_size asignamos al campo quantity 15
                        1 => ['quantity' => 15],
                        2 => ['quantity' => 15],
                        3 => ['quantity' => 15],
                        4 => ['quantity' => 15],
                    ]);
        }
    }
}
