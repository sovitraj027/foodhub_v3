<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'category_name' => 'Snacks',
            'category_slug' => 'snacks',
        ]);

        Category::create([
            'category_name' => 'Cold Drinks',
            'category_slug' => 'cold-drinks',
        ]);

        Category::create([
            'category_name' => 'Hard Drinks',
            'category_slug' => 'hard-drinks',
        ]);

        Category::create([
            'category_name' => 'Meal',
            'category_slug' => 'meal',
        ]);
    }
}
