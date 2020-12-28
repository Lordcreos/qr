<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\NotificationController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UpdateOrderStatusController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function updateStatus(Request $request,$id){
        $notification = new NotificationController();
////        return $request;
//        return $id;

        $data = request()->validate([
            'status'=>'required'
        ]);

        if(Order::whereId($id)->update($data)){
//            $order = Order::find($id);
////            $notification->WhatsAppOrderNotification($order);
            return back()->with(Toastr::success('Status Updated successfully ','Success'));
        }
        return back()->with(Toastr::success('Status Updated successfully ','Success'));
    }
}
