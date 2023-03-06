<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PackageRequest;
use App\Menu;
use App\Package;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class PackageController extends MainAdminController
{
    use FileUploadTrait;
   
    public function index()
    {
        return view('admin.meal_packages.index', [
            'packages' => Package::all(),
        ]);
    }

   
    public function create(Request $request)
    {

        if ($request->ajax()) {

            return Menu::where('menu_type', 'LIKE', "%$request->package_type%")->get();
        }

        return view('admin.meal_packages.create', [
            'menu_items' => Menu::all(),
        ]);
    }

    public function store(PackageRequest $request)
    {
        $package = Package::create($request->except('menu_items', 'image'));
        $package->status = $request->status == true ? '1' : '0';
        $package->save();
        if ($request->hasFile('image')) {
            $this->fileUpload($package, 'image', 'package-image', false);
        }
        $package->menus()->attach($request->menu_items);

        return redirect()->route('packages.index')->with('flash_message', 'Package Created');
    }

    public function show(Package $package)
    {
        //
    }

    public function edit(Package $package)
    {
        return view('admin.meal_packages.edit', [
            'package' => $package,
            'menu_items' => Menu::where('menu_type', $package->type)->get(),
            'package_menus' => $package->menus->pluck('id')->toArray()
        ]);
    }


    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->except('menu_items', 'image'));

        if ($request->hasFile('image')) {
            if (!is_null($package->image)) {

                $this->fileUpload($package, 'image', 'package-image', true);
            }
            $this->fileUpload($package, 'image', 'package-image', false);
        }
        $package->menus()->sync($request->menu_items);

        return redirect()->route('packages.index')->with('flash_message', 'Package Updated');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')->with('flash_message', 'Package Deleted');
    }
}
