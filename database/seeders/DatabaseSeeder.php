<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Eliminar la carpeta para no acumular imagenes innecesarias
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('subcategories');

        //Crear la carpeta donde se guardaran las imagenes
        //Como definimos en filesystem, lo hara en la carpeta public
        Storage::makeDirectory('categories');
        Storage::makeDirectory('subcategories');

        //LLamar al UserSeeder
        $this->call(UserSeeder::class);

        //LLamar al CategorySeeder
        $this->call(CategorySeeder::class);

        //LLamar al SubcategorySeeder
        $this->call(SubcategorySeeder::class);
    }
}
