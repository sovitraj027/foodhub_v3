<?php

use Database\Seeders\AdminSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
//    protected $toTruncate = ['users'];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();
 
        $this->call(AdminSeeder::class);
        // $this->call(PackageSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(MenuCategorySeeder::class);

//        Model::reguard();
    }
}
