<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use FileUploadTrait;


    public function index()
    {
        $categories = Categories::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "category_name" => "required",
                "category_image" => "required",
            ],
            [
                "category_name.requried" => "Category name is required",
                "category_image.required" => "image is Required",
            ]
        );
        $category = Categories::create($request->except('category_image', 'status'));
        $category->status = $request->status == true ? '1' : '0';
        $category->save();

        if ($request->hasFile('category_image')) {
            $this->fileUpload($category, 'category_image', 'category-image', false);
        }
        return redirect()->route('category.index')->with('message', 'Category Create Successfuly');
    }

    public function edit(Categories $category)
    {
        return view('admin.category.edit', compact('category',));
    }

    public function update(Request $request, Categories $category)
    {
        // dd($request->all());
        $request->validate(
            [
                "category_name" => "required",
                "category_image" => "nullable",
            ],
            [
                "category_name.requried" => "Category name is required",
            ]
        );

        $category->update($request->except('category_image','status'));
        $category->status = $request->status == true ? '1' : '0';
        $category->update();

        if ($request->hasFile('category_image')) {
            if (!is_null($category->category_image)) {

                $this->fileUpload($category, 'category_image', 'category-image', true);
            }
            $this->fileUpload($category, 'category_image', 'category-image', false);
        }

        return redirect()->route('category.index')->with('info', 'category Updated Successfully!');
    }



    public function destroy(Categories $category)
    {
        Storage::delete('public/category-image/' . $category->category_image);

        $category->delete();

        return redirect()->route('category.index')->with('error', 'Category Deleted Successfully!');
    }
}
