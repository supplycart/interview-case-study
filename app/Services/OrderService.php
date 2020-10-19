<?php
namespace App\Services;

use App\Contracts\OrderContract;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderService implements OrderContract
{
  public function getAll($request)
  {
    $order = Order::query();

    $order->when($request->has('status'), function ($query) use ($request){
      return $query->where('status_id', $request->status);
    });

    return $order->with('product', 'product.brand')->get();
  }

  public function newOrder($request)
  {
    $order = new Order();
    $order->product_id = $request->product_id;
    $order->cart_id = Auth::user()->cart->id;
    $order->quantity = $request->has('quantity') ? $request->quantity : 1;
    $order->status_id = $request->has('status_id') ? $request->status_id : 1;
    $order->save();

    $product = Product::find($request->product_id);
    $product->stock_count = $product->stock_count - $order->quantity;
    $product->save();

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