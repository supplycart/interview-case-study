<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notes;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\OrderProduct;

class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Auth::user()->cart->first()->orders;
        foreach($items as $item){
          $item->products;
        }
        return response()->json( $items );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = DB::table('status')->select('status.name as label', 'status.id as value')->get();
        return response()->json( $statuses );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order->products;
        return response()->json( $order );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cartId)
    {
      $user = Auth::user();
      $cart = Cart::firstOrCreate([
        'id' => $cartId
      ]);
      $order = Order::create([
        'cart_id' => $cartId
      ]);
        
      foreach($cart->products as $product){
        OrderProduct::create([
          'order_id' => $order->id,
          'product_id' => $product->id,
          'amount' => $product->pivot->amount
        ]);
      }

      foreach($cart->products as $product){
        CartProduct::findOrFail($product->pivot->id)->delete();
      }

      return response()->json( ['status' => 'success'] );
    }
   
}
