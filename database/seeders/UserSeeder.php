<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear usuario de prueba
        User::create([
            'name' => 'prueba',
            'email' => 'prueba@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
