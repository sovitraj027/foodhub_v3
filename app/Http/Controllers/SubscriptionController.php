<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\SubscriptionRequest;
use App\Mail\PackageOrderMail;
use App\Models\DeliveryOrder;
use App\Models\User;
use App\Package;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->check() && auth()->user()->usertype == 'Admin') {
            return view('subscription.index', [
                'subscriptions' => Subscription::with(['user', 'package'])->latest()->get()
            ]);
        }

        return view('subscription.index', [
            'subscriptions' => Subscription::where('user_id', auth()->id())->with(['user', 'package'])->latest()->get()
        ]);
    }


    public function create()
    {
        if (auth()->check() && auth()->user()->usertype == 'Admin') {
            return view('subscription.create', [
                'packages' => Package::select('id', 'name')->where('status', 1)->get()
            ]);
        }
    }

    public function store(SubscriptionRequest $request)
    {
        $insertedData = $request->except('_token', 'delivery_time');
        $sub = Subscription::create($insertedData);
        $sub->delivery_time = date('H:i:s', strtotime($request->delivery_time));
        if ($sub->subscription_type == 'Weekly') {
            $sub->days = 7;
        } else {
            $sub->days = 30;
        }
        $sub->save();
        $package = Package::where('id', $sub->package_id)->first();
        

        $user = Auth::user();
        $deliver_order = new DeliveryOrder();
        $deliver_order->user_id = $user->id;
        $deliver_order->delivery_location = $user->address;
        $deliver_order->delivery_time = date('H:i:s', strtotime($request->delivery_time));
        $deliver_order->type = "package";
        $deliver_order->status = "pending";
        $deliver_order->quantity = 1;
        $deliver_order->price = $package->price;
        $deliver_order->package_id = $package->id;
        $deliver_order->paid_status = 0;

        if ($request->status == 1) {
            $deliver_order->esewa_status = 1;
        } else {
            $deliver_order->esewa_status = 0;
        }
        $deliver_order->save();

        if (auth()->check() && auth()->user()->usertype == 'Admin') {
            return redirect()->route('subscription.index')->with('message', 'Subscription Added');
        }

        $details = [
            'user'=> $user,
            'package_name' => $package->name,
            'food_type' => $package->type,
            'price'=>$package->price,
            'deliver_location'=>$user->address,
            'package_type'=>$sub->subscription_type == 'Weekly'?'Weekly':'Monthly',
        ];

        $Adminemail = User::where('userType', 'Admin')->first();
        Mail::to($Adminemail->email)->send(
            new PackageOrderMail($details)
        );

        $DeliveryStaffEmail = User::where('userType', 'delivery_staff')->first();
        Mail::to($DeliveryStaffEmail->email)->send(
            new PackageOrderMail($details)
        );

        return view('pages.my_subscription', [
            'subscriptions' => Subscription::where('user_id', auth()->id())->with('package')->get()
        ])->with('message', 'Subscription Added');
    }

    public function edit(Subscription $subscription)
    {
        return view('subscription.edit', [
            'packages' => Package::select('id', 'name')->where('status', 1)->get(),
            'subscription' => $subscription
        ]);
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return redirect()->route('subscription.index')->with('flash_message', 'Subscription Updated');
    }


    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscription.index')->with('flash_message', 'Subscription Deleted');
    }
}
