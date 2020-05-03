<?php

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::create([
            'name_ar' => 'السعودية',
            'name_en' => 'KSA',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
