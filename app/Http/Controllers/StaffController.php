<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Models\DeliveryOrder;
use App\Models\User;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{

    //sorting algorithm
    public function index()
    {
        $delivery = DeliveryOrder::all();
        $items = $delivery->sortBy('delivery_time');
        

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
        
        if (count($order_list)>0 &&  $order_list[0] != null) {
           
            $order = $order_list[0];

            if (isset($order->package_id) != null) {
                $package = Package::FindOrFail($order->package_id);
            }
            if (isset($order->item_id) != null) {
                $menu = Menu::FindOrFail($order->item_id);
            }
            $user = User::FindorFail($order->user_id);
            $details = [
                'quantity' => $order->quantity,
                'package_name' => isset($package->name) ? $package->name : "",
                'item_name' => isset($menu->menu_name) ? $menu->menu_name : "",
                'price' => $order->price,
                'deliver_time' => $order->delivery_time,
                'user' => $user,
            ];

            $delivery_email = Auth::user()->email;
            Mail::to($delivery_email)->send(
                new \App\Mail\DeliveryInfoEmail($details)
            );
        }

        return view('rider.order_list', compact('order_list'));
    }

    public function PaymentStatus(Request $request)
    {

        $order = DeliveryOrder::find($request->order_id);
        $order->paid_status = $request->status;
        $order->esewa_status = $request->status;
        $order->save();
        return response()->json(['message' => 'Status change successfully.']);
    }
}
