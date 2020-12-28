<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\AddonCategory;
use Illuminate\Http\Request;

class AddoncategoryController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }

    public function add_addoncategory(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $data['store_id'] = auth()->id();

        if (AddonCategory::create($data))
            return back()->with("MSG", "Record added successfully")->with("TYPE", "success");
    }
    public function update_addoncategory(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        $data['store_id'] = auth()->id();

        if (AddonCategory::whereId($id)->update($data))
            return back()->with("MSG", "Record added successfully")->with("TYPE", "success");
    }

    public function add_addon(Request $request)
    {
        $data = request()->validate([
            'addon_name' => 'required',
            'addon_category_id' => 'required',
            'price' => 'required',

        ]);


        $data['store_id'] = auth()->id();

        if (Addon::create($data))
            return back()->with("MSG", "Record added successfully")->with("TYPE", "success");
    }



    public function update_addon(Request $request,$id){

        $data = request()->validate([
            'addon_name' => 'required',
            'addon_category_id' => 'required',
            'price' => 'required',
        ]);
        Addon::whereId($id)->update($data);
        return back()->with("MSG", "Record Updated Successfully.")->with("TYPE", "success");


    }
}
