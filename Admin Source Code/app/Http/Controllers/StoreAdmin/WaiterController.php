<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\WaiterCall;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function update_waiter_call_status(WaiterCall $id,Request $request){
        $data = request()->validate([
            'is_completed'=>'required'
        ]);
        if(WaiterCall::whereId($id->id)->update($data)){

            return back()->with(Toastr::success('Status Updated successfully ','Success'));
        }
        return back()->with(Toastr::success('Status Updated successfully ','Success'));
    }
}
