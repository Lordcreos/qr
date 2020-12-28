<?php

namespace App\Http\Controllers\Auth\Login;

use App\Application;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;
class StoreController extends DefaultLoginController
{
    protected $redirectTo = RouteServiceProvider::STORE;

    public function __construct()
    {
        $this->middleware('guest:store')->except('logout');
    }
    public function showLoginForm()
    {
        $account_info = Application::all()->first();
        return view('auth.login.store')->with(['account_info'=>$account_info]);
    }
    public function email()
    {
        return 'email';
    }
    protected function guard()
    {
        return Auth::guard('store');
    }
}
