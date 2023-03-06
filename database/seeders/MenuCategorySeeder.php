<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'menu_name' => 'Veg Chowmin',
            'menu_type' => \App\Package::Vegetarian,
            'menu_description' => 'Veg Chowmin',
            'price' => 100,
            'category_id' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Buff Chowmin',
            'menu_type' => \App\Package::Non_Vegetarian,
            'menu_description' => 'Buff Chowmin',
            'price' => 120,
            'category_id' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Chicken Chowmin',
            'menu_type' => \App\Package::Non_Vegetarian,
            'menu_description' => 'Chicken Chowmin',
            'price' => 130,
            'category_id' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Buff Momo',
            'menu_type' => \App\Package::Non_Vegetarian,
            'menu_description' => 'Buff Momo',
            'price' => 130,
            'category_id' => 1,
        ]);

       Menu::create([
            'menu_name' => 'Chicken Momo',
            'menu_type' => \App\Package::Non_Vegetarian,
            'menu_description' => 'Chicken Momo',
            'price' => 140,
            'category_id' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Veg Momo',
            'menu_type' => \App\Package::Vegetarian,
            'menu_description' => 'Veg Momo',
            'price' => 140,
            'category_id' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Veg thali',
            'menu_type' => \App\Package::Vegetarian,
            'menu_description' => 'Veg thali includes rice, veggies, lentils, and cutneys',
            'price' => 240,
            'category_id' => 4,
        ]);


        Menu::create([
            'menu_name' => 'Chicken thali',
            'menu_type' => \App\Package::Non_Vegetarian,
            'menu_description' => 'Chicken thali includes rice, veggies, chicken, lentils, and cutneys',
            'price' => 320,
            'category_id' => 4,
        ]);

    }
}
