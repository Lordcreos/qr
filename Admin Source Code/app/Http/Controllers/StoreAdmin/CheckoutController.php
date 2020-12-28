<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\SelectedSubscription;
use App\Models\Setting;
use App\Models\Store;
use App\Models\StoreSubscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;

class CheckoutController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function completeSubscriptionPayment(Request $request){
        $plan = StoreSubscription::all()->where('id','=',$request->plan_id)->first();
        $currency = Setting::all()->where('key','=','Currency')->first()->value;
        $secretKey = Setting::all()->where('key','=','StripeSecretKey')->first()->value;
        \Stripe\Stripe::setApiKey($secretKey);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => 'Subscription Plan '.$plan->name,
                    ],
                    'unit_amount' => explode('.',$plan->price)[0].explode('.',$plan->price)[1],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('store_admin.subscription_after_complete_payment'),
            'cancel_url' => route('store_admin.subscription_after_complete_payment'),
        ]);
        session(['transactional_id' => $session->id]);
        session(['plan_id' => $request->plan_id]);
        error_log('Some message here.');
        return response()->json($session);

    }
    public function completeSubscriptionAfterPayment(Request $request){
        $session_id = session('transactional_id');
        $secretKey = Setting::all()->where('key','=','StripeSecretKey')->first()->value;
        \Stripe\Stripe::setApiKey($secretKey);
        $payment_response_details= \Stripe\Checkout\Session::retrieve($session_id);

        if(!$session_id)
            abort('404');

        $plan_id = session('plan_id');
        $plan = StoreSubscription::all()->where('id','=',$plan_id)->first();
        $selected_plan = new SelectedSubscription();
        $selected_plan->subscription_name = $plan->name;
        $selected_plan->subscription_price = $plan->price;
        $selected_plan->subscription_days = $plan->days;
        $selected_plan->payment_status = $payment_response_details->payment_status;
        $selected_plan->payment_transactional_id = $session_id;
        $selected_plan->store_id = auth()->id();
        $selected_plan->save();

        if($payment_response_details->payment_status == "paid") {
            $id = Auth::user()->id;
            $store = Store::find($id);
            if ($store->subscription_end_date < date('Y-m-d'))
                $store->subscription_end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $plan->days . ' days'));
            else
                $store->subscription_end_date = date('Y-m-d', strtotime($store->subscription_end_date . ' +' . $plan->days . ' days'));
            $store->save();
            session()->forget('plan_id');
            session()->forget('transactional_id');
            return Redirect::route('store_admin.subscription_plans')->with("MSG", "Subscription updated Successfully your new Subscription end date is ".date('d-m-Y',strtotime(Store::find($id)->subscription_end_date)))->with("TYPE", "success");
        }else{
            return Redirect::route('store_admin.subscription_plans')->with("MSG", "Subscription updated failed due to incomplete payment please contact administration for queries")->with("TYPE", "danger");
        }

    }
}
