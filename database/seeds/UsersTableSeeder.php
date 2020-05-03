<?php

use App\User;
use App\Models\Client;
use App\Models\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $client = Client::create([
            'name' => 'client',
            'mobile' => '01234567890',
            'mobile_code' => '12345',
            'password' => Hash::make('123456'),
            'country_id' => '1',
            'city_id' => '1',
            'address' => 'address',
            'lat' => '31.0213456',
            'lng' => '31.0213456',
            'mobile_verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $provider = Provider::create([
            'name_ar' => 'مقدم خدمة',
            'name_en' => 'provider',
            'mobile' => '01234567890',
            'mobile_code' => '12345',
            'password' => Hash::make('123456'),
            'cat_id' => '1',
            'mobile_verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
