<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Menu;
use App\Package;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        // Create admin account
        DB::table('users')->insert([
            'usertype' => 'Admin',
            'first_name' => 'John',
            'last_name' => 'Deo',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'image_icon' => 'admin',
            // 'remember_token' => random_int(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('widgets')->insert([
            'footer_widget1_title' => 'About Restaurant',
            'footer_widget1_desc' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'footer_widget2_title' => 'Recent Tweets',
            'footer_widget2_desc' => '',
            'footer_widget3_title' => 'Contact Info',
            'footer_widget3_address' => 'Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing',
            'footer_widget3_phone' => '+01 123 456 78',
            'footer_widget3_email' => 'demo@example.com',
            'about_title' => 'About Us',
            'about_desc' => 'Aenean ultricies mi vitae est. Mauris placerat eleifend leosit amet est.',
            'need_help_title' => 'Need Help?',
            'need_help_phone' => '+61 3 8376 6284',
            'need_help_time' => 'Monday to Friday 9.00am - 7.30pm'

        ]);

        DB::table('settings')->insert([
            'site_name' => 'Cloud Kitchen',
            'currency_symbol' => 'Rs',
            'site_email' => 'admin@admin.com',
            'site_logo' => 'logo.png',
            'site_favicon' => 'favicon.png',
            'site_description' => 'Cloud Kitchen - Food Delivery Script Cloud Kitchen - Food Delivery is an laravel script for Delivery Restaurants',
            'site_copyright' => 'Copyright © 2016 Cloud Kitchen - Food Delivery Script. All Rights Reserved.',
            'home_slide_image1' => 'home_slide_image1.png',
            'home_slide_image2' => 'home_slide_image2.png',
            'home_slide_image3' => 'home_slide_image3.png',
            'page_bg_image' => 'page_bg_image.png',
            'total_restaurant' => '2550',
            'total_people_served' => '5355',
            'total_registered_users' => '12454'
        ]);

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

        Menu::create([
            'menu_name' => 'Mushroom Kebab',
            'menu_type' => \App\Package::Vegan,
            'menu_description' => 'Fresh Japanese Mushrooms',
            'price' => 520,
            'category_id' => 4,
        ]);

        Menu::create([
            'menu_name' => 'Fruit Salad',
            'menu_type' => \App\Package::Vegan,
            'menu_description' => 'Varieties of seasonal fruits',
            'price' => 160,
            'category_id' => 1,
        ]);

        $package1 = Package::create([
            'name' => 'Veg Platter',
            'description' => 'This is a veg snacks package',
            'type' => Package::Vegetarian,
            'price_per_day' => 200,

        ]);

        $package1->menus()->attach([1, 6, 7]);

        $package2 = Package::create([
            'name' => 'Non Veg Platter',
            'description' => 'This is a non veg package',
            'type' => Package::Non_Vegetarian,
            'price_per_day' => 140,
        ]);

        $package2->menus()->attach([2, 4]);

        $package3 = Package::create([
            'name' => 'Vegan Platter',
            'description' => 'This is a vegan snacks package',
            'type' => Package::Vegan,
            'price_per_day' => 100,
        ]);

        $package3->menus()->attach([8, 9]);

        $package4 = Package::create([
            'name' => 'Non Veg Khaja Set',
            'description' => 'This is set includes newari khaja items',
            'type' => Package::Non_Vegetarian,
            'price_per_day' => 250,
        ]);

        $package4->menus()->attach([3, 8]);


        // factory('App\User', 20)->create();
    }
}
