<?php

namespace App\Http\Controllers\Backend;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Menu;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.pages.menu', [
            'menu' => Menu::orderBy('menu_name')->get()
        ]);
    }

    public function create(){
       $categories = Categories::orderBy('category_name')->get();
       
       return view('admin.pages.addeditmenu', compact('categories'));
    }

    public function store(Request $request){
        dd($request->all());
    }
}
