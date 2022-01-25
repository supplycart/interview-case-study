<?php

namespace App\Http\Controllers;


use Auth;
use \App\Models\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            $userOrders = UserOrder::where("user_id", Auth::id())->get();
            return view('order', ["orders" => $userOrders]);
        }else{
            return view('logout');
        }
    }
}
