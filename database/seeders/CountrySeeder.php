<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::factory(5)->create()->each(function(Country $country){
            State::factory(5)->create([
                'country_id' => $country->id
            ]);
        });
    }
}
