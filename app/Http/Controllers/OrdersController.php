<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class OrdersController extends Controller
{
    public function index(StoreOrderRequest $request)
    {
        // return CartResource()
        $user = $request->user();
        
        return OrderResource::collection(Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get());
    }

    public function store(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        // create new order
        $total_price = 0;
        
        $orders = ShoppingCart::where(['user_id' => $user->id])->get();
        foreach ($orders as $order) {
            $total_price += $order->product_price * $order->quantity;
        }

        $orders = Order::create([
            'user_id' => $user->id,
            'total' => $total_price,
            'delivered'=>$data['delivered'],
        ]);

        $orders = ShoppingCart::query()->where(['user_id' => $user->id]);
        if($orders){
            $orders->delete();
        }

        return response([
            'orders' => $orders,
        ]);
    }
}
