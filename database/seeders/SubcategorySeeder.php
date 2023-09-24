<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creando algunas subcategorias
        $subcategories = [
            /* Hombres */
            [
                'category_id' => 1,
                'name' => 'Camisas',
                'slug' => Str::slug('Camisas'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Pantalones',
                'slug' => Str::slug('Pantalones'),
            ],
            [
                'category_id' => 1,
                'name' => 'Chamarras',
                'slug' => Str::slug('Chamarras'),
            ],
            /* Mujeres */
            [
                'category_id' => 2,
                'name' => 'Blusas',
                'slug' => Str::slug('Blusas'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Faldas',
                'slug' => Str::slug('Faldas'),
            ],
            [
                'category_id' => 2,
                'name' => 'Jeans',
                'slug' => Str::slug('jeans'),
            ],
            /* Niños */
            [
                'category_id' => 3,
                'name' => 'Camisas',
                'slug' => Str::slug('Camisas'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Pantalones',
                'slug' => Str::slug('Pantalones'),
            ],
            [
                'category_id' => 3,
                'name' => 'Sueteres',
                'slug' => Str::slug('Sueteres'),
            ],
            /* Accesorios */
            [
                'category_id' => 4,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
            [
                'category_id' => 4,
                'name' => 'Gorras',
                'slug' => Str::slug('Gorras'),
            ],
            [
                'category_id' => 4,
                'name' => 'Pulseras',
                'slug' => Str::slug('Pulseras'),
            ],
        ];

        //Integrar las subcategorias a sus respectivas categorias
        foreach($subcategories as $subcategory)
        {
            //Primero llamamos al factory que es el que crea la imagen
            //Despues creamos la subcategory pasandole el array
            Subcategory::factory(1)->create($subcategory);
        }
    }
}
