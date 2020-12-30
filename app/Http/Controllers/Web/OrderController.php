<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', '=', $user->id)->paginate(10);
        return view('app.order-list', ['orders' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cart_products = $cart->products;
        $order = new Order([
            'user_id' => $user->id
        ]);

        if ($cart_products->isEmpty()) {
            throw ValidationException::withMessages([
                'error' => 'Unable to place order, cart is empty'
            ]);
        }

        DB::transaction(function() use($order, $cart_products, $cart) {
            $order->save();
            $cart_products->each(function ($item, $key) use($order, $cart) {
                if ($item->pivot->product_quantity > $item->quantity) {
                    throw ValidationException::withMessages([
                        'product_quantity' => 'Unable to place order, there is not enough stock'
                    ]);
                }
                $order->products()->attach($item, [
                    'order_quantity' => $item->pivot->product_quantity,
                    'order_price' => $item->price,
                    'total_order_price' => ($item->price * $item->pivot->product_quantity)
                ]);

                $product_remainder = $item->quantity - $item->pivot->product_quantity;

                DB::table('products')
                    ->where('id', '=', $item->id)
                    ->update(['quantity' => $product_remainder]);

                $cart->products()->detach($item);
            });
        });

        OrderPlaced::dispatch($order);
        return redirect(route('orders-detail', ['order' => $order->id]))->with(
            'order_add_success',
            'Successfully placed order'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order_total = DB::table('order_product')
                            ->where('order_id', '=', $order->id)
                            ->sum('total_order_price');
        return view('app.order-detail', [
            'order_products' => $order->products,
            'order_total' => $order_total
            ]
        );
    }
}
