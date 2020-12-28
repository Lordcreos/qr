<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetails');
    }

    public function total_orders($phone) {
        return Order::all()->where('customer_phone','=',$phone)->sum('total');
    }
    public function total($phone) {
        return Order::all()->where('customer_phone','=',$phone)->count();
    }


}
