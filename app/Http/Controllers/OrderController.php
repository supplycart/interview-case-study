<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->orderByDesc('id')->paginate(15);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('orders.create', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        $order = new Order();
        $order->user_id = auth()->id();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone_no = $request->phone_no;
        $order->address = $request->address;
        $order->postcode = $request->postcode;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->status = 'success';
        if ($order->save()) {
            $carts = Cart::where('user_id', auth()->id())->get();

            $total = 0;
            foreach($carts as $cart) {
                $total = $total + ($cart->price * $cart->quantity);

                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cart->product_id;
                $orderItem->product_name = $cart->product_name;
                $orderItem->quantity = $cart->quantity;
                $orderItem->price = $cart->price;
                $orderItem->save();
            }

            $order->total = $total;
            $order->save();

            Cart::where('user_id', auth()->id())->delete();
        }

        ActivityLog::LogRecord('User Place Order');
        
        return redirect()->route('orders.index')->with('status', 'Success');
    }
}
