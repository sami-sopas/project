<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creando array de 4 categorias x default
        $categories = [
            [
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
            ],
            [
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
            ],
            [
                'name' => 'Niños',
                'slug' => Str::slug('Niños'),
            ],
            [
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios'),
            ],

        ];


        //Recorremos el array de arrays con los datos y los vamos creando
        foreach($categories as $category)
        {
            //A los registros hechos, en su factory le agregamos las imagenes
            Category::factory(1)->create($category);
        }
    }
}
