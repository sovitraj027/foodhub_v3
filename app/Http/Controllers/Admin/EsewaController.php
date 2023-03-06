<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EsewaController extends Controller
{

    public function esewaPaySuccess()
    { 
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amount = $_GET['amt'];

        $order = Order::where('product_id', $pid)->first();
        $order->esewa_status="1";
        $order->save();
        // $orders=Cart::where('user_id',Auth::user()->id)->orderBy('id')->get();
        // $price = DB::table('cart')->where('user_id', Auth::id())->sum('item_price');
        $user=Auth::user();
        $user_email = $user->email;
        $details=[
            'fname'=>$user->first_name,
            'amount' => $amount
            
        ];

        Mail::to($user_email)->send(
            new \App\Mail\EsewaSuccessMail($details)
        );

        return view('pages.thankyou',[
        ]);
    }

    public function esewaPayFailed()
    {
        $pid = $_GET['pid'];
        $order = Order::where('product_id', $pid)->first();
        //dd($order);
        $update_status = Order::find($order->id)->update([
            'esewa_status' => 'failed',
            'updated_at' => Carbon::now(),
        ]);
        if ($update_status) {
            //send mail,....
            //
            $msg = 'Failed';
            $msg1 = 'Payment is failed. Contact admin for support.';
            return view('thankyou', compact('msg', 'msg1'));
        }
    }
}
