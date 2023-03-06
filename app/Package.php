<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

    const Vegetarian = 'Vegetarian';
    const Non_Vegetarian = 'Non Vegetarian';
    const Vegan = 'Vegan';

    const types = [
        self::Vegetarian => self::Vegetarian,
        self::Non_Vegetarian => self::Non_Vegetarian,
        self::Vegan => self::Vegan,
    ];


    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

   /* public function menu_package_items()
    {
        return $this->hasMany(Menu::class, 'menu_type', 'type');
    }*/
}
