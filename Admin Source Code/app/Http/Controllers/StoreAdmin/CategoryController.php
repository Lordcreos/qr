<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function add_category(Request $request){


        $data = request()->validate([
            'name'=>'required',
            'image_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'=>'required',
            'store_id'=>''
        ]);
        $data['store_id'] = auth()->id();
        if($request->image_url !=NULL) {
            $url = $request->file("image_url")->store('public/stores/category/images/');
            $data['image_url'] = str_replace("public","storage",$url);
        }
        if(Category::create($data))
            return Redirect::route( "store_admin.categories" )->with(Toastr::success('Category Added successfully ','Success'));
    }
    public function update_category(Request $request,$id){
        $data = request()->validate([
            'name'=>'required',
            'image_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'=>'required'
        ]);
        if($request->image_url !=NULL) {
            Storage::delete(str_replace("storage","public",Category::find($id)->photo_url));
            $url = $request->file("image_url")->store('public/stores/category/images/');
            $data['image_url'] = str_replace("public","storage",$url);
        }
        Category::whereId($id)->update($data);
        return Redirect::route( "store_admin.categories" )->with(Toastr::success('Category Updated successfully ','Success'));


    }

    public function delete_category(Request $request)
    {
        if (Storage::delete(str_replace("storage", "public", Category::find($request->id)->image_url))) {
            Category::destroy($request->id);
        }
        return back()->with(Toastr::success('Category Deleted successfully ','Success'));

    }

}

