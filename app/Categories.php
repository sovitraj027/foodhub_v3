<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $guarded = [];

    public $timestamps = false;

    public function news()
    {
        return $this->hasMany('App\News', 'cat_id');
    }

    public static function getCategoryInfo($id)
    {
        return Categories::find($id);
    }
	
	public function menus(){
        return $this->hasMany(Menu::class,'category_id','id');
    }

}
