<?php

namespace App\Http\Controllers;

use App\User;
use App\Restaurants;
use App\Cart;
use App\Order;
use App\Menu;
use App\Types;

use App\Http\Requests;
use App\Mail\OrderinfoMail;
use App\Mail\OwnerMailMessage;
use App\Models\DeliveryOrder;
use Carbon\Carbon;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

date_default_timezone_set('Asia/Kathmandu');


// init composer autoloader.
require '../vendor/autoload.php';

class CartController extends Controller
{

    public function add_cart_item($item_id)
    {
        $user_id = Auth::user()->id;
        $find_cart_item = Cart::where(['user_id' => $user_id, 'item_id' => $item_id])->first();
        if ($find_cart_item != "") {
            $singl_item_price = $find_cart_item->item_price / $find_cart_item->quantity;
            $find_cart_item->increment('quantity');
            $new_quantity = $find_cart_item->quantity;
            $new_price = $singl_item_price * $new_quantity;
            $find_cart_item->item_price = $new_price;
            $find_cart_item->save();
        } else {
            $menu = Menu::findOrFail($item_id);
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->item_id = $menu->id;
            $cart->item_name = $menu->menu_name;
            $cart->item_price = $menu->price;
            $cart->quantity = '1';
            $cart->save();
        }
        return redirect()->back();
    }

    public function delete_cart_item($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back();
    }

    public function order_details()
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return view('pages.cart_order_details', compact('user'));
    }

    public function confirm_order_details(Request $request)
    {

        $data = $request->except('_token');
        $inputs = $request->all();
        $rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:75',
            'mobile' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'address' => 'required'
        );
        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
        $user->city = $inputs['city'];
        $user->postal_code = $inputs['postal_code'];
        $user->address = $inputs['address'];
        $user->save();
        $cart_res = Cart::where('user_id', $user_id)->orderBy('id')->get();

        foreach ($cart_res as $n => $cart_item) {
            $pid = uniqid();
            $order = new Order;
            $order->product_id = $pid;
            $order->user_id = $user_id;
            $order->item_id = $cart_item->item_id;
            $order->item_name = $cart_item->item_name;
            $order->item_price = $cart_item->item_price;
            $order->quantity = $cart_item->quantity;
            $order->created_date = strtotime(date('Y-m-d'));
            $order->status = 'Pending';
            if ($request->status == 1)
                $order->cash_status = 0;
            else
                $order->cash_status = 1;
            $order->save();
            $user_details = User::where('userType', 'Admin')->first();
            $order_list = Cart::where('user_id', $user_id)->orderBy('id')->get();
            $details = [
                'name' => $inputs['first_name'],
                'order_list' => $order_list
            ];

            $email = $user_details->email;
            Mail::to($email)->send(
                new OwnerMailMessage($details)
            );

            $DeliveryStaffEmail= User::where('userType', 'delivery_staff')->first();
            Mail::to($DeliveryStaffEmail->email)->send(
                new OrderinfoMail($details)
            );

            $successUrl = url('/success');
            $failureUrl = url('/failure');

            if ($request->status == 1) {
                // config for development
                $config = new Config($successUrl, $failureUrl);
                // initialize eSewa client
                $esewa = new Client($config);

                $esewa->process($order->product_id, $order->item_price, 0, 0, 0);
            }

            //user mail
            $order_list = Order::where(array('user_id' => $user_id, 'status' => 'Pending'))->orderBy('item_name', 'desc')->get();
            $order_list = Cart::where('user_id', $user_id)->orderBy('id')->get();
            $details = [
                'name' => $inputs['first_name'],
                'order_list' => $order_list,
                'subject' => getcong('site_name') . ' Order Confirmed',

            ];

            $user_order_email = $inputs['email'];
            Mail::to($user_order_email)->send(
                new \App\Mail\OderMail($details)
            );

            $currentTime = Carbon::now();
            $oneHourLater = $currentTime->addHour();

            $user = Auth::user();
            $deliver_order = new DeliveryOrder;
            $deliver_order->user_id = $user->id;
            $deliver_order->delivery_location = $user->address;
            $deliver_order->delivery_time = $oneHourLater;
            $deliver_order->type = "normal";
            $deliver_order->status = "pending";
            $deliver_order->quantity = $cart_item->quantity;
            $deliver_order->price = $cart_item->item_price;
            $deliver_order->paid_status = 0;
            $deliver_order->item_id = $cart_item->item_id;
            if ($request->status == 1) {
                $deliver_order->esewa_status = 1;
            } else {
                $deliver_order->esewa_status = 0;
            }
            $deliver_order->save();
        }
        return view('pages.cart_order_confirm_details');
    }


    public function user_orderlist()
    {
        $user_id = Auth::user()->id;
        $order_list = DeliveryOrder::where('user_id', $user_id)->orderBy('id', 'desc')->where('item_id', '!=', null)->get();
        return view('pages.my_order', compact('order_list'));
    }


    public function cancel_order($order_id)
    {
        $order = DeliveryOrder::findOrFail($order_id);
        $order->status = 'Cancel';
        $order->save();
        \Session::flash('flash_message', 'Order has been cancel');

        return \Redirect::back();
    }
}
