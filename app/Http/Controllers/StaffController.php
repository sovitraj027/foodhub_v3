<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Models\DeliveryOrder;
use App\Models\User;
use App\Package;
use App\Settings;
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

    public function updateLocation(Request $request){

        $minLat = 27.4167;
        $maxLat = 27.8042;
        $minLng = 85.342034;
        $maxLng = 85.342049;

        $lat = mt_rand($minLat * 1000000, $maxLat * 1000000) / 1000000;
        $lng = mt_rand($minLng * 1000000, $maxLng * 1000000) / 1000000;

        $user=User::FindOrFail(Auth::user()->id);
        $user->latitude=$lat;
        $user->longitude=$lng;
        $user->save();

        return redirect()->back()->with('message', 'Successfuly change location');

    }

    public function location(Request $request){
        $setting=Settings::first();
        $rider=User::where('usertype', 'delivery_staff')->first();
        $user=Auth::user();
        return view('pages.my_order_location',compact('setting','rider','user'));
    }

}
