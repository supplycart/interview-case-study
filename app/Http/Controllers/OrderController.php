<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Http\Controllers\CartController as Cart;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Get a validator for an incoming order request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'        =>  ['required', 'string', 'max:255'],
            'last_name'         =>  ['required', 'string', 'max:255'],
            'address'           =>  ['required', 'string', 'max:255'],
            'city'              =>  ['required', 'string', 'max:255'],
            'country'           =>  ['required', 'string', 'max:255'],
            'post_code'         =>  ['required', 'integer', 'phone_number', 'size:4'],
            'phone_number'      =>  ['required', 'integer', 'phone_number', 'size:11'],
        ]);
    }

    public function index()
    {
        $orders = Order::has('items')->with('items.product')->where('user_id', auth()->user()->id)->get();

        return view('order', compact('orders'));
    }

    public function place(Request $request)
    {
        $this->validate($request, [
            'first_name'        =>  ['required', 'string', 'max:255'],
            'last_name'         =>  ['required', 'string', 'max:255'],
            'address'           =>  ['required', 'string', 'max:255'],
            'city'              =>  ['required', 'string', 'max:255'],
            'country'           =>  ['required', 'string', 'max:255'],
            'post_code'         =>  ['required', 'integer', 'size:4'],
            'phone_number'      =>  ['required', 'integer', 'size:11'],
        ]);
        
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $request->input('total'),
            'item_count'        =>  Cart::getQtyTotal(),
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'first_name'        =>  $request->input('first_name'),
            'last_name'         =>  $request->input('last_name'),
            'address'           =>  $request->input('address'),
            'city'              =>  $request->input('city'),
            'country'           =>  $request->input('country'),
            'post_code'         =>  $request->input('post_code'),
            'phone_number'      =>  $request->input('phone_number'),
            'notes'             =>  ''
        ]);

        if ($order) {
            $items = session('cart');
            foreach ($items as $id => $item)
            {
                $orderItem = new OrderItem([
                    'product_id'    =>  $id,
                    'quantity'      =>  $item['quantity'],
                    'price'         =>  $item['quantity'] * $item['price']
                ]);

                $order->items()->save($orderItem);
            }
            session()->forget('cart');
            return redirect('/order');
        }
    }

}
