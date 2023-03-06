<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = ['restaurant_id','category_id','menu_name', 'menu_description','price','menu_image','menu_type'];


	public $timestamps = false;

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

	public static function getMenunfo($id) 
    { 
		return self::find($id);
	}
	 
}
