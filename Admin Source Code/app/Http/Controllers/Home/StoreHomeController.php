<?php

namespace App\Http\Controllers\Home;

use App\Application;
use App\Category;
use App\Homes;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TranslationService;
use App\Models\Setting;
use App\Models\Store;
use App\Models\StoreSubscription;
use App\Product;
use App\Slider;
use App\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreHomeController extends Controller
{
    public function home(){
        $transation = new TranslationService();

        $account_info = Application::all()->first();
        return view('Home.index',[
            'account_info'=>$account_info,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }


    public function start(){
        $account_info = Application::all()->first();
        return view('Home.start',[
            'account_info'=>$account_info
        ]);
    }



    public function register(){
        $subscription = StoreSubscription::all();
        $account_info = Application::all()->first();
        return view('Home.register',[
            'account_info' =>$account_info,
            'subscription'=>$subscription
        ]);
    }

    public function pricing(){
        $subscription = StoreSubscription::all();
        $account_info = Application::all()->first();
        return view('Home.pricing',[
            'account_info' =>$account_info,
            'subscription'=>$subscription
        ]);
    }

    public function privacy(){
        $privacy = Setting::all()->where('key','PrivacyPolicy')->first()->value;
        $home = Homes::all();
        $account_info = Application::all()->first();
        return view('Home.privacy',[
            'account_info' =>$account_info,
            'home'=>$home,
            'privacy'=>$privacy
        ]);
    }


    public function index($view_id)
    {
//        return 1;
        $account_info = Application::all()->first();

        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
        if(Store::all()->where('view_id','=',$view_id)->where('is_visible','=',1)->where('subscription_end_date','>=',date('Y-m-d'))->count()==0)
            return view('Home.404',[
                'account_info' =>$account_info,
            ]);
        $store = Store::all()->where('view_id','=',$view_id)->first();
        $store_id  = $store['id'];
        $store_name  = $store['store_name'];
        $description  = $store['description'];

        return view('Home.show_store',[
            'account_info' =>$account_info,
            ]);
    }


    public function indexjs($view_id)
    {
        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
        if(Store::all()->where('view_id','=',$view_id)->where('is_visible','=',1)->count()==0)
            return view('Home.404');

        $store = Store::all()->where('view_id','=',$view_id)->first();
        $store_id  = $store['id'];
        $store_name  = $store['store_name'];
        $description  = $store['description'];
        $sliders = Slider::all()->where('is_visible','=',1);
        $recommended = Product::all()->where('store_id','=',$store_id)
            ->where('is_recommended','=',1)
            ->where('is_active','=',1)->sortBy('name');

        $categories = Category::all()->where('store_id','=',$store_id)
            ->where('is_active','=',1)->sortBy('name');

        $products = Product::all()->where('store_id','=',$store_id)
            ->where('is_active','=',1)->sortBy('name');
        $account_info = Application::all()->first();

        return view('Home.show_store_old',['recommended'=>$recommended,
            'categories'=>$categories,
            'products'=>$products,
            'account_info'=>$account_info,
            'store_name'=>$store_name,
            'description'=>$description,
            'sliders'=>$sliders
        ]);
    }
    public function RegisterNewStore(Request $request){
        $data = request()->validate([
            'store_name'=>'required',
            'email'=>['required',Rule::unique('stores','email')],
            'password'=>'required',
            'phone'=>'required',
            'address'=>'',
            'description'=>'',
            'theme_id'=>'',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['logo_url'] = "NaN";
        $data['view_id'] = sha1(time());
        $plan = StoreSubscription::all()->where('id','=',$request->plan)->first();
        if($plan->price ==0){
            $data['subscription_end_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$plan->days.' days'));

        }else{
            $data['subscription_end_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
        }
        if(Store::create($data))
            return redirect(route('store.login'))->with("MSG","Account Created successfully")->with("TYPE", "success");
    }
    public function product_details(){
//        return 1;

        return view('Home.show_store');
    }



}
