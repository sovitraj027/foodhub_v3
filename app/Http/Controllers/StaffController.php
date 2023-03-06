<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    
    //sorting algorithm
    public function index()
    {
        $items=DeliveryOrder::all();
        $order_list = $items->sortBy(function ($item) {
            return $item['type'];
        })->when('package', function ($collection) {
            return $collection->sort(function ($a, $b) {
                // Sorting logic for package items
                if ($a['delivery_time'] == $b['delivery_time']) {
                    return 0;
                }
                return ($a['delivery_time'] < $b['delivery_time']) ? -1 : 1;
            });
        })->values();
        return view('rider.order_list',compact('order_list'));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
