<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        $results = new Collection;
        $orders = Order::where('user_id', Auth::user()->id)->get();

        foreach ($orders as $order) 
        {
            $products = $order->products()->get();
            $results->push(['order' => $order, 'products' => $products]);
        }

        return response()->json(['results' => $results, 200]);
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $order = new Order();
        $order->total_cost = $request->totalPrice;
        $order->user_id = Auth::user()->id;
        $order->save();

        foreach ($request->products as $product)
        {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }
        
        $order->user()->associate($user);

        return response()->json(['message' => 'Place Order Successfully!'], 200);
    }
}
