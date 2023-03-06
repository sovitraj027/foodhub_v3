<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    const Weekly = 'Weekly';
    const Monthly = 'Monthly';

    const subscription_types = [
        self::Weekly => self::Weekly,
        self::Monthly => self::Monthly,
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($subscription) {
            $subscription->user_id = auth()->id();

            if ($subscription->subscription_type == Subscription::Weekly) {
                $subscription->subscribed_to = Carbon::parse(request()->subscribed_from)->addDays(7);
            } else {
                $subscription->subscribed_to = Carbon::parse(request()->subscribed_from)->addMonth(1);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
