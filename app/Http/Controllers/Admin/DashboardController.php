<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Types;
use App\Restaurants;
use App\Categories;
use App\Menu;
use App\Review;
use App\Order;
use App\Http\Requests;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;


class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
         
    }
    public function index()
    { 
            $categories_count = Categories::count();

            $menu_count = Menu::count();

            $order_count = DeliveryOrder::count();

            $review_count = Review::count();

               return view('admin.pages.owner_dashboard',compact('categories_count','menu_count','order_count','review_count')); 
            
    }
	
	 
    	
}
