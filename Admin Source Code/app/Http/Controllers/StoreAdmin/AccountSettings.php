<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class AccountSettings extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function update_store_settings(Request $request){

        $data = request()->validate([
            'store_name'=>'required',
            'email'=>'',
            'password'=>'',
            'phone'=>'required',
            'logo_url'=>'',
            'address'=>'',
            'currency_symbol'=>'',
            'service_charge'=>'',
            'tax'=>'',
            'description'=>'',

        ]);
        $data['is_accept_order'] = isset($request['is_accept_order']) ? 1:0;
        if ($request->logo_url != NULL) {
            Storage::delete(str_replace("storage","public",Store::find(auth()->id())->logo_url));
            $url = $request->file("logo_url")->store('public/stores/logo');
            $data['logo_url'] = str_replace("public","storage",$url);
        }
        if($request->password == NULL)
            unset($data['password']);
        else
            $data['password'] = Hash::make($request['password']);

        if(Store::whereId(auth()->id())->update($data)) {
            return back()->with(Toastr::success('Settings Updated Successfully.','Success'));
        }
    }
}
