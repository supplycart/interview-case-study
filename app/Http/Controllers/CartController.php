<?php


namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::where('token', session()->getId());

        if (auth()->user()) {
            $items = $items->orWhere('user_id', auth()->user()->id);
        }

        $items = $items->get();

        return view('cart.index', compact('items'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // check item already in cart
        $cart_exist = Cart::where('product_id', $product->id)->where('token', session()->getId())->first();

        if ($cart_exist) {
            $cart_exist->quantity = $cart_exist->quantity + $request->quantity;
            $cart_exist->save();
        }
        else {
            Cart::create([
                'product_id' => $product->id,
                'token' => session()->getId(),
                'user_id' => (auth()->user()) ? auth()->user()->id : 0,
                'quantity' => $request->quantity
            ]);
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();

        return back()->with('success', 'Item deleted from cart.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);

        $items = Cart::where('user_id', auth()->user()->id)->get();

        if ($items->count() >= 1) {

            // create order
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'total_amount' => $items->sum('sub_total'),
                'address' => $request->address,
            ]);

            foreach ($items as $item) {
                // create order item
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'price' => $item->product->product_price,
                    'quantity' => $item->quantity,
                    'total' => $item->sub_total,
                ]);

                // delete from cart
                $item->delete();
            }

            return redirect()->route('order.index')->with('success', 'Successfully placed order.');
        }

        return back()->with('error', 'Issue with order placement.');
    }
}
