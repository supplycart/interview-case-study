<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use Auth;
use Session;
use Illuminate\Support\Str;
use Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId =  Auth::id();
        $orders = Order::where('user_id', $userId)->select('items.name', 'orders.quantity', 'orders.total', 'orders.order_id')->leftJoin('items', 'orders.item_id', '=', 'items.id')->get();
        $ordersList = [];
        foreach($orders as $order){
            $ordersList[$order['order_id']][] = [
                'name' => $order['name'],
                'quantity' => $order['quantity'],
                'total' => $order['total']];
            if(isset($ordersList[$order['order_id']]['grand_total'])){
                $ordersList[$order['order_id']]['grand_total'] += $order['total'];
            } else {
                $ordersList[$order['order_id']]['grand_total'] = $order['total'];
            }
        }
        return Inertia::render('Orders')->with(["data" => $ordersList]);
    }

    public function store(Request $request)
    {
        $userId =  Auth::id();
        $orderId = Str::uuid()->toString();
        foreach($request->all() as $itemId => $item){
            Order::create([
                'user_id' => $userId,
                'order_id' => $orderId,
                'item_id' => $itemId,
                'quantity' => $item['qty'],
                'total' => ($item['qty']*$item['price'])
            ]);

        }
        Session::forget('cart');

    }
}
