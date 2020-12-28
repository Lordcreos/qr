<?php

namespace App\Http\Controllers\WEBAPI;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Order;
use App\Models\OrderDetailAddon;
use App\Models\OrderDetails;
use App\Models\Store;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Notification\NotificationController;

class OrderController extends Controller
{

    public function create(Request $request){
                $data = $request->all();
                $orderItems = $request->cart;
                unset($data['cart']);
                $store_id = Store::all()->where('view_id','=',$request->store_id)->first()['id'];
                $data['store_id'] = $store_id;
                $data['order_unique_id'] = "ODR-".time();
                $new_order = Order::create($data);
                $new_order['status'] = 1;
                $notification = new NotificationController();

                if($new_order){
                    $order_id = Order::all()->where('order_unique_id','=', $data['order_unique_id'])->first()['id'];
                    $items = array();
                    foreach($orderItems as $value){
                        $temp = [];
                        $temp['order_id'] = $order_id;
                        $product = Product::all()->where('id','=',$value['itemId'])->first();
                        if($value['addon'] == null) {
                            $temp['name'] = $product['name'];
                            $temp['price'] = $product['price'];
                        }else{
                            $addon = Addon::find($value['addon']);
                            $temp['name'] = $product['name'] ."-". $addon->addon_name;
                            $temp['price'] = $product['price']+$addon->price;
                        }
                        $temp['quantity'] = $value['count'];
//                        $items[] = $temp;
                        $orderDetail = OrderDetails::create($temp);
//                        return $orderDetail;
                        if($value['extra'] !=NULL){
//                            return $value['extra'];
                            $temp = array();
                            foreach($value['extra'] as $value){
                                $addon = Addon::find($value['addon_id']);
                                $temp['order_detail_id'] = $orderDetail->id;
                                $temp['addon_name'] = $addon->addon_name;
                                $temp['addon_price'] = $addon->price;
                                $temp['addon_count'] = $value['count'];
                                OrderDetailAddon::create($temp);
                            }
                        }
                    }


                        $response_data = Order::all()->where('customer_phone','=',$request->customer_phone);



                        $response = [];
                        foreach ($response_data as $value)
                            $response[] = $value;

                      $notification->WhatsAppOrderNotification(Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$new_order->id)->get()->toArray());
                        return response()->json([
                            "success" => true,
                            "status" => "success",
                            "payload" => [
                                'data' => $response
                            ]
                        ], 200);


                 }
    }
    public function fetch(Request $request){
            $response_data = Order::all()->where('customer_phone','=',$request->customer_phone)->sortByDesc('id');
            $response = [];

            foreach ($response_data as $value) {
                $value['store_name'] = Store::all()->where('id','=',$value['store_id'])->first()['store_name'];
                $response[] = $value;
            }
            return response()->json([
                "success" => true,
                "status" => "success",
                "payload" => [
                    'data' => $response
                ]
            ], 200);
        }

}
