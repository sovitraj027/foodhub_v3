<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Package;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Models\DeliveryOrder;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;

class FoodMenuController extends Controller
{
    use FileUploadTrait;

    public function __construct()
    {
        $this->middleware('auth')->only('viewSubscriptionModel', 'userSubscriptionCreate', 'mySubscriptionModel', 'myPackageStatus');
    }

    public function index()
    {
        return view('admin.menu.index', [
            'menu' => Menu::orderBy('menu_name')->get()
        ]);
    }


    public function create()
    {
        $categories = Categories::orderBy('category_name')->get();
        return view('admin.menu.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                "menu_name" => "required",
                "menu_image" => "required",
                "menu_type" => "required",
                "menu_description" => "required",
                "price" => "required|integer",
                "category_id" => "required",
            ],

            [
                "menu_name.requried" => "Category name is required",
                "menu_image.required" => "image is Required",
                "category_id.required" => "menu is required",
                "menu_description.required" => "Description is required",
                "menu_type.required" => "type is required",
            ]
        );

        $menu = Menu::create($request->except('menu_image', 'status'));

        $menu->status = $request->status == true ? '1' : '0';

        $menu->save();

        if ($request->hasFile('menu_image')) {

            $this->fileUpload($menu, 'menu_image', 'menu-image', false);
        }

        return redirect()->route('menus.index')->with('message', 'Menu Create Successfuly');
    }

    public function show($id)
    {
    }

    public function edit(Menu $menu)
    {
        $categories = Categories::orderBy('category_name')->get();
        return view('admin.menu.edit', compact('categories', 'menu'));
    }


    public function update(Request $request, Menu $menu)
    {
        $request->validate(
            [
                "menu_name" => "required",
                "menu_type" => "required",
                "menu_description" => "required",
                "price" => "required|integer",
                "category_id" => "required",
            ],

            [
                "menu_name.requried" => "Category name is required",
                "category_id.required" => "menu is required",
                "menu_description.required" => "Description is required",
                "menu_type.required" => "type is required",
            ]
        );

        $menu->update($request->except('menu_image', 'status'));
        $menu->status = $request->status == true ? '1' : '0';
        $menu->update();
        if ($request->hasFile('menu_image')) {

            if (!is_null($menu->image)) {
                $this->fileUpload($menu, 'menu_image', 'menu-image', true);
            }
            $this->fileUpload($menu, 'menu_image', 'menu-image', false);
        }
        return redirect()->route('menus.index')->with('info', 'Menu Updated Successfully!');
    }

    public function destroy(Menu $menu)
    {
        Storage::delete('public/menu-image/' . $menu->menu_image);
        $menu->delete();
        return redirect()->route('menus.index')->with('error', 'Menu Deleted Successfully!');
    }

    public function getMenus($slug)
    {
        $category = Categories::where('category_slug', $slug)->first();
        return view('pages.restaurants_menu', compact('category'));
    }

    public function viewSubscriptionModel()
    {
       
        return view('pages.view_subscription', [
            'packages' => Package::where('status', 1)->with('menus')->get()
        ]);
    }

    public function userSubscriptionCreate($packageId)
    {
        return view('pages.add_subscription', [
            'package_id' => $packageId,
            'packages' => Package::select('id', 'name')->where('status', 1)->get()
        ]);
    }

    public function mySubscriptionModel()
    {
        return view('pages.my_subscription', [
            'subscriptions' => Subscription::where('user_id', auth()->id())->get()
        ]);
    }

    public function myPackageStatus($packageId){
        $order=DeliveryOrder::where('user_id',auth()->user()->id)->where('package_id', $packageId)->first();
        $package=Package::find($packageId);
        
        return view('pages.package_status', [
            'order' => $order,
            'package'=>$package

        ]);
      
    }
}
