<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use App\Models\Addon;
use App\Models\AddonCategory;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SelectedSubscription;
use App\Models\Setting;
use App\Models\StoreSlider;
use App\Models\StoreSubscription;
use App\Models\Table;
use App\Models\WaiterCall;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RestaurantAdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:store');
    }
    public function index()
    {
        $store_id = Auth::user()->id;
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $order_count = Order::all()->where('store_id','=', $store_id )->count();
        $item_sold = DB::table('orders')->where('store_id','=', $store_id )
            ->select('*')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->where('orders.status','=',4)
            ->get()->sum('quantity');

        $earnings = Order::all()->where('status','=',4)->where('store_id','=', $store_id )->sum('total');
        $account_info = Application::all()->first();
        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',1);


        $notification = $this->notification();



        return view('restaurants.dashboard',[
            "order_count"=>$order_count,
            "item_sold"=>$item_sold,
            "earnings"=> $earnings,
            "account_info" =>  $account_info,
            'orders'=>$orders,
            'notification'=>$notification,
            'sanboxNumber'=>$sanboxNumber,
            'root_name' => 'Dashboard',
        ]);
    }

    public function orderstatus(){

        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',2);
        $neworder = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',1);
        $ready = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',5);
        return view('restaurants.orderstatus',[
            'orders'=>$orders,
            'neworder'=>$neworder,
            'ready'=>$ready,
            'root_name' => 'Order Status Screen',
            'sanboxNumber'=>$sanboxNumber,
        ]);

    }

    public function orders(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id());
        $orders_count = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        return view('restaurants.orders',[
            'orders'=>$orders,
            'orders_count'=>$orders_count,
            'root_name' => 'Orders',
            'sanboxNumber'=>$sanboxNumber,
        ]);

    }
    public function new_orders(){


        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id());
        $orders_count = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        $response = array();
        foreach ( $orders as $data)
            $response[] = $data;

        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'orders' =>$response,
                'count' =>$orders_count
            ]
        ], 200);

    }
    public function view_order(Order $id){

        $orderDetails =  Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$id->id)->get()->toArray();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        return OrderDetails::with('OrderDetailsExtraAddon')->get();
//        return $orderDetails;
        $account_info = Application::all()->first();
        return view('restaurants.view_order',[
            'order'=>$id,
            'orderDetails'=>$orderDetails,
            'account_info'=>$account_info,
            'root_name' => 'Orders',
            'sanboxNumber'=>$sanboxNumber,
        ]);

    }
    public function categories(){

        $category_count = Category::all()->where('store_id', auth()->id())->count();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        $category = Category::all()->SortByDesc('id')->where('store_id', auth()->id());
        return view('restaurants.category',[
            'title' => 'category',
            'root_name' => 'category',
            'root' => 'category',
            'category'=>$category,
            'category_count'=>$category_count,
            'sanboxNumber'=>$sanboxNumber,
        ]);


    }
    public function addcategories(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.addcategory',['root_name' => 'Category','sanboxNumber'=>$sanboxNumber,]);

    }
    public function update_category(Category $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        return view('restaurants.editcategory',
            [
                'title' => 'update Category',
                'root_name' => 'Category',
                'root' => 'Category',
                'data' => $id,
                'sanboxNumber'=>$sanboxNumber,

            ]);
    }

    public function products(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $products_count = Product::all()->where('store_id', auth()->id())->count();
        $products = Product::all()->SortByDesc('id')->where('store_id', auth()->id());
        $productsnonveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 0);
        $productsveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 1);
        $productsdisabled = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_active', '=', 0);
        return view('restaurants.products',[
            'products'=>$products,
            'products_count'=>$products_count,
            'root_name' => 'Products',
            'productsnonveg' => $productsnonveg,
            'productsveg' => $productsveg,
            'productsdisabled' => $productsdisabled,
            'sanboxNumber'=>$sanboxNumber,

        ]);
    }

    public function addproducts(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $category = Category::all()->where('store_id', auth()->id());
        $addon_category = AddonCategory::all()->where('store_id', auth()->id());
        return view('restaurants.addproducts',[
            'category'=>$category,
            'addon_category'=>$addon_category,
            'root_name' => 'Products',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }

    public function update_products(Product $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addon_category = AddonCategory::all()->where('store_id', auth()->id());
        $category = Category::all()->where('store_id', auth()->id());
        return view('restaurants.editproducts',
            [
                'title' => 'update Products',
                'root_name' => 'Products',
                'root' => 'Products',
                'data' => $id,
                'category'=>$category,
                'addon_category'=>$addon_category,
                'sanboxNumber'=>$sanboxNumber,
            ]);
    }


    public function addon_categories(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addons_count = AddonCategory::all()->where('store_id', auth()->id())->count();
        $addons = AddonCategory::all()->SortByDesc('id')->where('store_id', auth()->id());
        return view('restaurants.addons.addon_categories',[
            'addons'=>$addons,
            'addons_count'=>$addons_count,
            'root_name' => 'Addon Category',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }

    public function addon_categories_edit(AddonCategory $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        return view('restaurants.addons.edit_addon_categories',
            [
                'title' => 'update Category',
                'root_name' => 'Category',
                'root' => 'Category',
                'data' => $id,
                'root_name' => 'Addon Category',
                'sanboxNumber'=>$sanboxNumber,

            ]);
    }


    public function addon(){
        $addons_category= AddonCategory::all()->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addon_count = Addon::all()->where('store_id', auth()->id())->count();
        $addon = Addon::all()->SortByDesc('id')->where('store_id', auth()->id());
        return view('restaurants.addons.addon',[
            'addon'=>$addon,
            'addon_count'=>$addon_count,
            'addons_category' => $addons_category,
            'root_name' => 'Addons',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }
    public function update_addon(Addon $id){

        $addons_category= AddonCategory::all()->where('store_id', auth()->id());
        $addon_count = Addon::all()->where('store_id', auth()->id())->count();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        return view('restaurants.addons.update_addon',[
            'addon'=>$id,
            'addon_count'=>$addon_count,
            'addons_category' => $addons_category,
            'root_name' => 'Addons',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }


    public function tables(){

        $tables = Table::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.all_tables',[
            'title' => 'All Tables',
            'tables'=>$tables,
            'root_name' => 'Tables',
            'sanboxNumber'=>$sanboxNumber,
        ]);

    }
    public function table_report(){
        $tables = Table::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.table_report',[
            'title' => 'All Tables',
            'tables'=>$tables,
            'root_name' => 'Table Report',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }
    public function add_table(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;


        return view('restaurants.tables.add_new_table',[
            'title' => 'Add New Tables',
            'root_name' => 'Tables',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }


    public function edit_table(Table $id){
        $head_name="Update Table";
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.edit_table',compact('id'),[
            'title' => 'Table',
            'root_name' => 'Table',
            'root' => 'Table',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }


    public function banner(){
        $banner = StoreSlider::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.banner',[
            'title' => 'All Tables',
            'banner'=>$banner,
            'root_name' => 'Banners',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }

    public function banneredit(StoreSlider $id){
        $head_name="Update Banner";
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.edit_banner',compact('id'),[
            'title' => 'Banner',
            'root_name' => 'Banner',
            'root' => 'Banner',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }




    public function addbanner(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.addbanner',[
            'title' => 'Add Banner',
            'root_name' => 'Banners',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }

    public function subscription_plans(){
        $publishableKey = Setting::all()->where('key','=','StripePublishableKey')->first()->value;
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $subscription = StoreSubscription::all()->where('is_active','=',1)->where('price','!=',0);
        $subscription_count = StoreSubscription::all()->where('is_active','=',1)->where('price','!=',0)->count();
        $isStripeEnabled =  Setting::all()->where('key','=','IsStripePaymentEnabled')->first()->value;
        return view('restaurants.plans',[
            'title' => 'Subscription Plans',
            'subscription_count'=> $subscription_count,
            'subscription'=>$subscription,
            'publishableKey'=>$publishableKey,
            'isStripeEnabled'=> $isStripeEnabled,
            'root_name' => 'Subscription',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }
    public function subscription_history(){
        $store_plan_history = SelectedSubscription::all()->where('store_id','=',\auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.store_subscription.history',[
            'store_plan_history' => $store_plan_history,
            'root_name' => 'Subscription History',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }

    public function settings(){
        $store = Auth::user();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        return view('restaurants.settings.index',[
            'title' => 'Settings',
            'store' =>$store,
            'root_name' => 'Settings',
            'sanboxNumber'=>$sanboxNumber,

        ]);
    }

    public function notification(){
        $notification = array();
        if(Auth::user()->subscription_end_date < date('Y-m-d')) {
            $notification['head'] = "YOUR SUBSCRIPTION HAS EXPIRED";
            $notification['sub_head'] = "Please renew your subscription to continue enjoying our services.";
            $notification['route_submit_button_name'] = "Renew Now";
            $notification['route'] = "store_admin.subscription_plans";
        }
        return $notification;
    }
    // customers
    public function customers(){
        $customers = Order::all()->sortByDesc('id')->unique('customer_phone')->where('store_id','=',auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        return $customers[0]->total_orders(9544752154);
        return view('restaurants.customers.index',[
            'title' => 'Customers',
            'customers' => $customers,
            'root_name' => 'Customers',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }
    public function waiter_calls(){
        $calls = WaiterCall::all()->where('store_id','=',auth()->id())->sortByDesc('id');
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

//        return $customers[0]->total_orders(9544752154);
        return view('restaurants.waiterCall.view',[
            'title' => 'Customers',
            'count' => $calls->where('is_completed','=',0)->count(),
            'calls' => $calls,
            'root_name' => 'Waiter Call',
            'sanboxNumber'=>$sanboxNumber,
        ]);
    }

}
