<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Main screen
Route::get('/store/register', "Home\StoreHomeController@register")->name('store_register');
Route::post('/store/register', "Home\StoreHomeController@RegisterNewStore")->name('register_new_store');


Route::get('/store/pricing', "Home\StoreHomeController@pricing")->name('store_pricing');
Route::get('/store/privacy', "Home\StoreHomeController@privacy")->name('privacy');


Route::get('/', "Home\StoreHomeController@home")->name('home');
Route::get('/start', "Home\StoreHomeController@start")->name('start');

Route::post('/change/language', "TranslationService@language_switcher")->name('change_language');


Route::get('/store/{view_id}', "Home\StoreHomeController@index")->name('view_store');
Route::get('/store/cart/{all}', "Home\StoreHomeController@index")->where('all', '.*');
Route::get('/store/{view_id}/product/details/{product_id}', "Home\StoreHomeController@index")->where('all', '.*');
Route::get('/store/{view_id}/category/details/{product_id}', "Home\StoreHomeController@index")->where('all', '.*');
Route::get('/store/view/qr/{view_id}/print','Home\QrController@print')->name('download_qr');
Route::get('/store/view/tblqr/{view_id}/{table_no}/print','Home\QrController@tblprint')->name('download_tblqr');
// admin side
Route::get('/admin/dashboard', 'AdminPageController@dashboard')->name('dashboard');
Route::get('/admin/dashboard/store/add', 'AdminPageController@add_store')->name('add_store');
Route::get('/admin/dashboard/store/all', 'AdminPageController@all_stores')->name('all_stores');
Route::get('/admin/dashboard/store/{id}/edit', 'AdminPageController@edit_stores')->name('edit_stores');
Route::post('/admin/dashboard/store/create', 'Admin\StoreController@create')->name('create_store');
Route::post('/admin/dashboard/store/{id}/update',"Admin\StoreController@update")->name('update_store');
Route::get('/admin/dashboard/sliders', 'AdminPageController@all_slider')->name('all_sliders');
Route::get('/admin/dashboard/slider/add', 'AdminPageController@add_slider')->name('add_slider');
Route::get('/admin/dashboard/slider/{id}/update', 'AdminPageController@update_slider')->name('update_slider');
Route::post('/admin/dashboard/slider/add', 'Admin\SliderController@add_slider')->name('upload_slider');
Route::patch('/admin/dashboard/slider/{id}/update', 'Admin\SliderController@update_slider')->name('edit_slider');
Route::delete('/admin/dashboard/slider/delete', 'Admin\SliderController@delete_slider')->name('delete_slider');


Route::get('/admin/dashboard/settings', 'AdminPageController@settings')->name('settings');
Route::post('/admin/dashboard/settings', 'Admin\ApplicationController@update_account')->name('update_settings');
Route::post('/admin/dashboard/payment/settings/update', 'Admin\ApplicationController@update_payment_settings')->name('update_payment_settings');

Route::get('/admin/dashboard/settings/account', 'AdminPageController@account_settings')->name('account_settings');

Route::get('/admin/dashboard/settings/payment', 'AdminPageController@paymentsettings')->name('paymentsettings');
Route::post('/admin/dashboard/settings/payment', 'Admin\ApplicationController@update_account_settings')->name('update_account_settings');

Route::get('/admin/dashboard/settings/privacy', 'AdminPageController@privacy_policy')->name('privacy_policy');
Route::post('/admin/dashboard/settings/privacy/update', 'Admin\ApplicationController@update_privacy_policy')->name('update_privacy_policy');

Route::get('/admin/dashboard/settings/whatsapp', 'AdminPageController@whatsapp')->name('whatsapp');
Route::post('/admin/dashboard/whatsapp/settings/update', 'Admin\ApplicationController@update_whatsapp')->name('update_whatsapp');



// Database Migration:
Route::get('/admin/dashboard/settings/cache', 'AdminPageController@cache_settings')->name('cache_settings');
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return back()->with("MSG","Database Succssfully  Updated")->with("TYPE", "success");})->name('clear_app');


// Config Cache
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return back()->with("MSG","Config cache cleared")->with("TYPE", "success");})->name('config_cache');

// application Cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return back()->with("MSG","Application cache cleared")->with("TYPE", "success");})->name('app_cache');
// view Cache
Route::get('/view-cache', function() {
    $exitCode = Artisan::call('view:clear');
    return back()->with("MSG","Application cache cleared")->with("TYPE", "success");})->name('view_cache');


Route::get('/newvalue', function() {
    $exitCode = Artisan::call('db:seed --class=TwilloSeeder');
    return back()->with("MSG","Application cache cleared")->with("TYPE", "success");})->name('newvalue');

Route::get('/insertdata', function() {
    $exitCode = Artisan::call('db:seed');
    return back()->with("MSG","Seed Successfully Updated")->with("TYPE", "success");})->name('insertdata');


Route::get('/privacynew', function() {
    $exitCode = Artisan::call('db:seed --class=PrivacyPolicySeeder');
    return back()->with("MSG","Application cache cleared")->with("TYPE", "success");})->name('privacynew');





//subscription

Route::get('/admin/dashboard/subscription/all', 'AdminPageController@subscription')->name('all_subscription');
Route::get('/admin/dashboard/subscription/add', 'AdminPageController@addsubscription')->name('add_subscription');
Route::get('/admin/dashboard/subscription/{id}/edit', 'AdminPageController@editsubscription')->name('edit_subscription');
Route::patch('/admin/dashboard/subscription/{id}/edit', 'Admin\SubscriptionController@editsubscription')->name('update_subscription');

Route::post('/admin/dashboard/subscription/add', 'Admin\SubscriptionController@add_subscription')->name('add_new_subscription');


//translations
Route::get('/admin/dashboard/translations/all', 'AdminPageController@translations')->name('translations');

Route::get('/admin/dashboard/translations/add', 'AdminPageController@add_translations')->name('add_translations');
Route::post('/admin/dashboard/translations/add', 'Admin\TranslationController@add_translation')->name('add_translation');

Route::get('/admin/dashboard/translations/update/{id}', 'AdminPageController@update_translation')->name('update_translation');

Route::patch('/admin/dashboard/translations/update/{id}', 'Admin\TranslationController@update_translation')->name('update_translation');


//Route::get('/store/{view_id}', "Home\StoreHomeController@index")->name('view_store');
Route::any('/account/{all}/',"Home\UserController@index")->where('all', '.*');








Route::get('/restaurants/addproducts',function (){
    return view('restaurants.addproducts');
});

Route::get('/restaurants/orders',function (){
    return view('restaurants.orders');
});

Route::get('/restaurants/vieworder',function (){
    return view('restaurants.vieworder');
});


Route::prefix('store/auth')
    ->as('store.')
    ->group(function() {
        Route::namespace('Auth\Login')
            ->group(function() {
                Route::get('login', 'StoreController@showLoginForm')->name('login');
                Route::post('login', 'StoreController@login')->name('login');
                Route::post('logout', 'StoreController@logout')->name('logout');
            });
    });

Route::prefix('/admin/store/') ->as('store_admin.')
    ->group(function () {
        Route::get('dashboard',"RestaurantAdminPageController@index")->name('dashboard');


        Route::get('orders',"RestaurantAdminPageController@orders")->name('orders');
        Route::get('new_orders',"RestaurantAdminPageController@new_orders")->name('new_orders');

        Route::get('orders/details/{id}',"RestaurantAdminPageController@view_order")->name('view_order');
        Route::get('orders/status',"RestaurantAdminPageController@orderstatus")->name('orderstatus');


        Route::patch('orders/status/{id}/update',"StoreAdmin\UpdateOrderStatusController@updateStatus")->name("update_order_status");
        Route::get('categories',"RestaurantAdminPageController@categories")->name('categories');


        Route::get('addcategories',"RestaurantAdminPageController@addcategories")->name('addcategories');
        Route::get('editcategories/{id}/update', 'RestaurantAdminPageController@update_category')->name('update_category');
        Route::get('products',"RestaurantAdminPageController@products")->name('products');
        Route::get('addproducts',"RestaurantAdminPageController@addproducts")->name('addproducts');
        Route::get('editproducts/{id}/update', 'RestaurantAdminPageController@update_products')->name('update_products');

//        Route::get('userChangeStatus', 'RestaurantAdminPageController@userChangeStatus');

        Route::post('addcategories', 'StoreAdmin\CategoryController@add_category')->name('addcategories');
        Route::patch('editcategories/{id}/update', 'StoreAdmin\CategoryController@update_category')->name('edit_category');
        Route::post('addproducts', 'StoreAdmin\ProductController@addproducts')->name('addproducts');
        Route::patch('editproducts/{id}/update', 'StoreAdmin\ProductController@edit_products')->name('edit_products');
        Route::delete('products/delete', 'StoreAdmin\ProductController@delete_product')->name('delete_product');
        Route::delete('categories/delete', 'StoreAdmin\CategoryController@delete_category')->name('delete_category');


        // Addon Categories
        Route::get('addon_categories',"RestaurantAdminPageController@addon_categories")->name('addon_categories');
        Route::get('addon_categories/{id}/update', 'RestaurantAdminPageController@addon_categories_edit')->name('addon_categories_edit');
        Route::patch('addon_categories/{id}/update', 'StoreAdmin\AddoncategoryController@update_addoncategory')->name('addon_categories_update');
        Route::post('addaddoncategories', 'StoreAdmin\AddoncategoryController@add_addoncategory')->name('addaddoncategories');

        Route::get('addon',"RestaurantAdminPageController@addon")->name('addon');
        Route::post('addaddon', 'StoreAdmin\AddoncategoryController@add_addon')->name('add_addon');

        Route::get('update/addon/{id}', 'RestaurantAdminPageController@update_addon')->name('update_addon');
        Route::patch('update/addon/{id}', 'StoreAdmin\AddoncategoryController@update_addon')->name('update_addon');


        Route::get('/alltables', 'RestaurantAdminPageController@tables')->name('all_tables');
        Route::get('/all/table/report', 'RestaurantAdminPageController@table_report')->name('table_report');

        Route::get('addnewtable', 'RestaurantAdminPageController@add_table')->name('add_tables');
        Route::post('addnewtable', 'StoreAdmin\TableController@add_table')->name('add_new_table');
        Route::get('alltables/{id}/edit', 'RestaurantAdminPageController@edit_table')->name('edit_table');
        Route::patch('alltables/{id}/edit', 'StoreAdmin\TableController@edit_table')->name('edit_table');
        Route::get('/banner', 'RestaurantAdminPageController@banner')->name('banner');
        Route::get('addbanner',"RestaurantAdminPageController@addbanner")->name('addbanner');
        Route::post('addbanner',"StoreAdmin\StoreSliderController@add_slider")->name('add_banner');
        Route::get('/banner/{id}/edit', 'RestaurantAdminPageController@banneredit')->name('banneredit');
        Route::patch('banner/{id}/edit', 'StoreAdmin\StoreSliderController@update_slider')->name('update_slider');
        Route::delete('banner/delete', 'StoreAdmin\StoreSliderController@delete_slider')->name('delete_slider');
        Route::get('/subscription/plans', 'RestaurantAdminPageController@subscription_plans')->name('subscription_plans');
        Route::get('/subscription/plans/history', 'RestaurantAdminPageController@subscription_history')->name('subscription_history');
        Route::post('/subscription/compete/payment', 'StoreAdmin\CheckoutController@completeSubscriptionPayment')->name('subscription_complete_payment');
        Route::get('/subscription/compete/payment/complete', 'StoreAdmin\CheckoutController@completeSubscriptionAfterPayment')->name('subscription_after_complete_payment');
        Route::get('/settings', 'RestaurantAdminPageController@settings')->name('settings');
        Route::post('/settings/update', 'StoreAdmin\AccountSettings@update_store_settings')->name('update_store_settings');
    // customers
        Route::get('/customers', 'RestaurantAdminPageController@customers')->name('customers');
        Route::get('/waiter/calls', 'RestaurantAdminPageController@waiter_calls')->name('waiter_calls');
        Route::patch('/waiter/call/update/{id}', 'StoreAdmin\WaiterController@update_waiter_call_status')->name('update_waiter_call_status');
});
Auth::routes();
Route::get('/storejs/{view_id}', "Home\StoreHomeController@indexjs");

Route::get('/test', "Notification\NotificationController@FcmStoreNotification");
