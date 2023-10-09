<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $colors = [
            ['name' => 'White', 'hex_code' => '#ffffff'],
            ['name' => 'Blue', 'hex_code' => '#250be6'],
            ['name' => 'Red', 'hex_code' => '#ff3300'],
            ['name' => 'Black', 'hex_code' => '#000000'],
        ];
        
        foreach ($colors as $color) {
            Color::create([
                'name' => $color['name'],
                'hex_code' => $color['hex_code'],
            ]);
        }
        
    }
}
