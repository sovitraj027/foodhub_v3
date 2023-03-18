<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Order;
use App\Categories;
use App\Restaurants;

use App\Http\Requests;
use App\Mail\OderSuccessMessage;
use App\Menu;
use App\Models\DeliveryOrder;
use App\Package;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Intervention\Image\Facades\Image;
use PDF;



class OrderController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }


    public function alluser_order()
    {

        $order_list = Order::orderBy('id', 'desc')->orderBy('created_date', 'desc')->get();

        // if(Auth::User()->usertype!="Admin"){
        //     \Session::flash('flash_message', 'Access denied!');

        //     return redirect('admin/dashboard');

        // }

        return view('admin.pages.order_list_for_all', compact('order_list'));
    }

    public function order_status($order_id, $status)
    {
        $order = DeliveryOrder::findOrFail($order_id);
        if ($status == "Completed") {
            if (isset($order->package_id) != null) {
                $package = Package::FindOrFail($order->package_id);
                $delivery_order = DeliveryOrder::find($order_id);
                $sub = Subscription::where('package_id', $package->id)->where('user_id', $delivery_order->user_id)->first();
                $sub->decrement('days', 1);
            }
            if (isset($order->item_id) != null) {
                $menu = Menu::FindOrFail($order->item_id);
            }

            $user = User::FindorFail($order->user_id);

            $data = [
                'quantity' => $order->quantity,
                'package_name' => isset($package->name) ? $package->name : "",
                'item_name' => isset($menu->menu_name) ? $menu->menu_name : "",
                'price' => $order->price,
                'user' => $user,

            ];
            $pdf = PDF::loadView('pdf.invoice', $data);

            if ($order->type == 'normal'){
                $order->delete();
            }
            $user_details = User::where('userType', 'Admin')->first();
            $details = [
                'quantity' => $order->quantity,
                'package_name' => isset($package->name) ? $package->name : "",
                'item_name' => isset($menu->menu_name) ? $menu->menu_name : "",
                'price' => $order->price,
                'user' => $user,
            ];

            Mail::to($user_details->email)->send(
                new OderSuccessMessage($details)
            );

            return $pdf->download('invoice.pdf');
        } else {
            $order->status = $status;
            $order->save();
            return redirect()->back()->with('message', 'Status Changed Successfully');
        }
    }

    public function delete($order_id)
    {
        if (Auth::User()->usertype != "Admin") {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard')->with('error', 'Access Denied');
        }
        $order = Order::findOrFail($order_id);
        $order->delete();

        return redirect()->back()->with('error', 'Order Deleted Successfully');
    }


    public function owner_orderlist()
    {

        $user_id = Auth::User()->id;

        $restaurant = Restaurants::where('user_id', $user_id)->first();

        $restaurant_id = $restaurant['id'];


        $order_list = Order::where("restaurant_id", $restaurant_id)->orderBy('created_date')->get();

        if (Auth::User()->usertype != "Owner") {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
        }
        return view('admin.pages.owner.order_list', compact('order_list', 'restaurant_id'));
    }

    public function owner_order_status($order_id, $status)
    {
        $order = Order::findOrFail($order_id);
        $order->status = $status;
        $order->save();
        \Session::flash('flash_message', 'Status change');
        return \Redirect::back();
    }

    public function owner_delete($order_id)
    {
        if (Auth::User()->usertype != "Owner") {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
        }

        $order = Order::findOrFail($order_id);
        $order->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();
    }
}
