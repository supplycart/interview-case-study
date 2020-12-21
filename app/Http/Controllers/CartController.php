<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use DB;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id', 
            'qty' => 'required|integer' 
        ]);
    
        
        $carts = json_decode($request->cookie('af-carts'), true); 
      
        
        if ($carts && array_key_exists($request->product_id, $carts)) {
            $carts[$request->product_id]['qty'] += $request->qty;
        } else {
            $product = Product::find($request->product_id);

            $carts[$request->product_id] = [
                'qty' => $request->qty,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_desc' => $product->description,
                'product_price' => $product->price,
                'product_image' => $product->image
            ];
        }

        $cookie = cookie('af-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('af-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }


    public function listCart()
    {
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price']; 
        });
        
        return view('shops.cartlist', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $carts = $this->getCarts();

        foreach ($request->product_id as $key => $row) {

            if ($request->qty[$key] == 0) {
                unset($carts[$row]);
            } else {
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }

        $cookie = cookie('af-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }

    public function processCheckout(Request $request)
    {
        
       
        DB::beginTransaction();
        try {

            $carts = $this->getCarts();
            
            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });        

            $user = Auth::user();
            
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(), 
                'customer_id' => $user->id,
                'customer_name' => $user->name,
                'customer_phone' => $user->phone_number,
                'customer_address' => $user->address,
                'subtotal' => $subtotal
            ]);

            
            foreach ($carts as $row) {
            
                $product = Product::find($row['product_id']);
            
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'price' => $row['product_price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);
            }
            
            DB::commit();

            $carts = [];
            
            $cookie = cookie('af-carts', json_encode($carts), 2880);
            
            return redirect(route('finishProcess', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            
            DB::rollback();
            
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        
        $order = Order::where('invoice', $invoice)->first();
        $order_detail = OrderDetail::where('order_id', $order->id)
             ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
             ->get();
        
        return view('shops.invoice', compact('order', 'order_detail'));
    }

}
