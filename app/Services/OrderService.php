<?php
namespace App\Services;

use App\Contracts\OrderContract;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService implements OrderContract
{
  public function getAll($request)
  {
    $order = Order::query();

    return $order->get();
  }

  public function newOrder($request)
  {
    $order = new Order();
    $order->product_id = $request->product_id;
    $order->cart_id = Auth::user()->cart->id;
    $order->quantity = $request->has('quantity') ? $request->quantity : 1;
    $order->save();

    return $order;
  }

  public function updateOrder($request, $id)
  {
    $order = Order::find($id);
    $order->quantity = $request->quantity;
    $order->status_id = $request->status_id;
    $order->save();

    return $order;
  }
}