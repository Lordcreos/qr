<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $guarded = [];
    public function total_order_count($table_number) {
        return Order::all()->where('table_no','=',$table_number)->where('status','=',4)->count();
    }
    public function total_order_sum($table_number) {
        return Order::all()->where('table_no','=',$table_number)->where('status','=',4)->sum('total');
    }
}
