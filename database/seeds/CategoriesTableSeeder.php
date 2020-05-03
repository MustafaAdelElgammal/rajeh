<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
            'name_ar' => 'المقاولات',
            'name_en' => 'Construction',
            'image' => 'admin',
            'desc_ar' => 'المقاولات',
            'desc_en' => 'Construction',
            'is_featured' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $category = Category::create([
            'name_ar' => 'الجليسات',
            'name_en' => 'Sitters',
            'image' => 'admin',
            'desc_ar' => 'الجليسات',
            'desc_en' => 'Sitters',
            'is_featured' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
