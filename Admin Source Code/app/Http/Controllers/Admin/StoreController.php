<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Brian2694\Toastr\Facades\Toastr;

class StoreController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
        $data = request()->validate([
            'store_name'=>'required',
            'email'=>['required',Rule::unique('stores','email')],
            'password'=>'required',
            'phone'=>'required',
            'logo_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            'address'=>'',
            'description'=>'',
            'theme_id'=>'',
            'subscription_end_date'=>'required',
            'is_visible'=>'required'

        ]);

       $data['password'] = Hash::make($data['password']);
        if($request->logo_url !=NULL) {
           $url = $request->file("logo_url")->store('public/stores/logo');
           $data['logo_url'] = str_replace("public","storage",$url);
        }

        $data['view_id'] = sha1(time());
       if(Store::create($data))
           return back()->with(Toastr::success('Record added successfully','Success'));
    }

    public function update(request $data,$id)
    {
        $request = request()->validate([
            'store_name'=>'required',
            'email'=>'',
            'password'=>'',
            'phone'=>'required',
            'logo_url'=>'',
            'address'=>'',
            'description'=>'',
            'theme_id'=>'',
            'subscription_end_date'=>'required',
            'is_visible'=>'required'

        ]);
        if ($data->logo_url != NULL) {
            Storage::delete(str_replace("storage","public",Store::find($id)->logo_url));
            $url = $data->file("logo_url")->store('public/stores/logo');
            $request['logo_url'] = str_replace("public","storage",$url);
        }
        if($data->password == NULL)
            unset($request['password']);
        else
            $request['password'] = Hash::make($request['password']);


        Store::whereId($id)->update($request);
        return back()->with(Toastr::success('Record added successfully','Success'));

    }


    }
