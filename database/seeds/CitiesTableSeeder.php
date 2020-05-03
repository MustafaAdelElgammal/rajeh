<?php

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = City::create([
            'country_id' => 1,
            'name_ar' => 'الدمام',
            'name_en' => 'Dammam',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
