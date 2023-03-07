
<?php

use App\Models\DeliveryOrder;
use App\Settings;
use App\Widgets;
use App\Types;

 
if (! function_exists('getcong')) {

    function getcong($key)
    {
    	 
        $settings = Settings::findOrFail('1'); 

        return $settings->$key;
    }
}

if (! function_exists('getcong_widgets')) {

    function getcong_widgets($key)
    {
    	 
        $widgets = Widgets::findOrFail('1'); 

        return $widgets->$key;
    }
}


if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (! function_exists('getcong_type')) {

    function getcong_type($key)
    {
         
        $rtype = Types::findOrFail($key); 

        return $rtype->type;
    }
}

if (!function_exists('user_exist')) {

    function user_exist($user)
    {
      
        if($user!=null){
        $user_exist=DeliveryOrder::where('user_id',$user->id)->where('status','Processing')->exists();
        }
        if(!empty($user_exist)){
            return true;
        }
        else{
            return false;
        }


    }
}

