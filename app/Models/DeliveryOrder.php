<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;
    protected $table= "delivery_orders";
    protected $fillable=[
        'user_id',
        'delivery_location',
        'delivery_time',
        'type',
        'status',
        'paid_status',
        'esewa_status',
        'quantity',
        'price',
        'package_id',
        'item_id'
    ];
}
