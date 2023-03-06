<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EsewaController;
use App\Http\Controllers\Admin\FoodMenuController;
use App\Http\Controllers\Admin\IndexControlle;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WidgetsController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SubscriptionController;



Route::post('esewapay', [EsewaController::class, 'esewaPay'])->name('esewaPay');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

	// Route::get('/', [AdminIndexController::class, 'index'])->name('home');

	Route::post('login', [IndexController::class, 'postLogin']);
	Route::get('logout', [IndexController::class, 'logout']);

	Route::get('dashboard', [DashboardController::class, 'index']);

	Route::get('profile', [AdminController::class, 'profile']);
	Route::post('profile', [AdminController::class, 'updateProfile']);
	Route::post('profile_pass', [AdminController::class, 'updatePassword']);

	Route::get('settings', [SettingsController::class, 'settings']);
	Route::post('settings', [SettingsController::class, 'settingsUpdates']);
	Route::post('homepage_settings', [SettingsController::class, 'homepage_settings']);
	Route::post('addthisdisqus', [SettingsController::class, 'addthisdisqus']);
	Route::post('headfootupdate', [SettingsController::class, 'headfootupdate']);

	Route::get('restaurants/view/orderlist', [OrderController::class, 'orderlist']);
	Route::get('restaurants/view/orderlist/{order_id}/{status}', [OrderController::class, 'order_status']);
	Route::get('restaurants/view/orderlist/{order_id}', [OrderController::class, 'delete']);

	Route::get('allorder', [OrderController::class, 'alluser_order']);

	//Owner

	// Route::get('categories', 'CategoriesController@owner_categories');
	// Route::get('categories/addcategory', 'CategoriesController@owner_addeditCategory');
	// Route::get('categories/addcategory/{cat_id}', 'CategoriesController@editCategory');
	// Route::post('categories/addcategory', 'CategoriesController@addnew');
	// Route::get('categories/delete/{cat_id}', 'CategoriesController@delete');


	Route::get('orderlist', [OrderController::class, 'owner_orderlist']);
	Route::get('orderlist/{order_id}/{status}', [OrderController::class, 'owner_order_status']);
	Route::get('orderlist/{order_id}', [OrderController::class, 'owner_delete']);


	Route::get('users', [UsersController::class, 'userslist']);
	Route::get('users/adduser', [UsersController::class, 'addeditUser']);
	Route::post('users/adduser', [UsersController::class, 'addnew'])->name('addUser');
	Route::get('users/adduser/{id}', [UsersController::class, 'editUser']);
	Route::get('users/delete/{id}', [UsersController::class, 'delete']);
	Route::get('user/delivery_staffs', [UsersController::class, 'getStaffs'])->name('user.staff');
	// Route::get('changeStatus', [UsersController::class,'changeStatus'])->name('changeStatus');

	Route::get('widgets', [WidgetsController::class, 'index']);
	Route::post('footer_widgets', [WidgetsController::class, 'footer_widgets']);
	Route::post('about_widgets', [WidgetsController::class, 'about_widgets']);
	Route::post('socialmedialink', [WidgetsController::class, 'socialmedialink']);
	Route::post('need_help', [WidgetsController::class, 'need_help']);
	Route::post('featuredpost', [WidgetsController::class, 'featuredpost']);
	Route::post('advertise', [WidgetsController::class, 'advertise']);

	Route::get('/getMenus/{slug}', [FoodMenuController::class, 'getMenus'])->name('getMenus');
	Route::get('/view-subscriptions-model', [FoodMenuController::class, 'viewSubscriptionModel'])->name('viewSubscriptionModel');
	Route::get('/user_subscription.create/{packageId}', [FoodMenuController::class, 'userSubscriptionCreate'])->name('userSubscriptionCreate');
	Route::get('/my-subscriptions-model', [FoodMenuController::class, 'addSubscriptionModel'])->name('mySubscriptionModel');
});

Route::resource('category', CategoryController::class);
Route::resource('packages', PackageController::class);
Route::resource('subscription', SubscriptionController::class);
Route::resource("menus", FoodMenuController::class);
Route::resource("staffs", StaffController::class);
Route::get('changeStatus', [UsersController::class, 'changeStatus']);

Route::get('payment', [StaffController::class, 'PaymentStatus']);



Route::get('/', [IndexController::class, 'index']);

Route::get('login', [IndexController::class, 'login'])->name('login');

Route::post('login', [IndexController::class, 'postLogin']);

Route::get('register', [IndexController::class, 'register']);

Route::post('register', [IndexController::class, 'register_user']);

Route::get('logout', [IndexController::class, 'logout']);

Route::get('profile', [IndexController::class, 'profile']);

Route::post('profile', [IndexController::class, 'editprofile']);

Route::get('change_pass', [IndexController::class, 'change_password']);

Route::post('change_pass', [IndexController::class, 'edit_password']);

Route::get('about', [IndexController::class, 'about_us']);

Route::get('contact', [IndexController::class, 'contact_us']);

Route::get('add_item/{item_id}', [CartController::class, 'add_cart_item']);

Route::get('delete_item/{item_id}', [CartController::class, 'delete_cart_item']);


Route::get('order_details', [CartController::class, 'order_details']);

Route::post('order_details', [CartController::class, 'confirm_order_details']);

Route::post('epay_details', [EsewaController::class, 'paywithesewa'])->name('epay');

Route::get('/success', [EsewaController::class, 'esewaPaySuccess']);
Route::get('/failure', [EsewaController::class, 'esewaPayFailed']);

Route::get('myorder', [CartController::class, 'user_orderlist']);


Route::get('cancel_order/{order_id}', [CartController::class, 'cancel_order']);

Route::resource('subscription', SubscriptionController::class);

// Password reset link request routes...
Route::get('admin/password/email', [PasswordController::class, 'getEmail']);
Route::post('admin/password/email', [PasswordController::class, 'postEmail']);

// Password reset routes...
Route::get('admin/password/reset/{token}', [PasswordController::class, 'getReset']);
Route::post('admin/password/reset', [PasswordController::class, 'postReset']);

Route::post('contact_send', [IndexController::class, 'contact_send']);
