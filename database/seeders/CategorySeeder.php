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
                'icon' => '<span class="material-icons-outlined">man</span>',
            ],
            [
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'icon' => '<span class="material-icons-outlined">woman</span>',
            ],
            [
                'name' => 'Niños',
                'slug' => Str::slug('Niños'),
                'icon' => '<span class="material-icons-outlined">child_friendly</span>',
            ],
            [
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios'),
                'icon' => '<span class="material-icons-outlined">watch</span>'
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
