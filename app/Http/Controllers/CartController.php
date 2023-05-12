<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Cart;
use App\Models\CartItem;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data['carts'] = Cart::select('id')->with('items:id,cart_id,product_id,quantity', 'items.product:id,name,price,image')->where('user_id', Auth::id())->first()?->items;
        $data['total'] = 0;

        if($data['carts']){
            foreach ($data['carts'] as $key => $item) {
                $data['total'] += round(($item->product->price * $item->quantity), 2);
            }
            $data['total'] = number_format($data['total'], 2);
        }else{
            $data['total'] = number_format($data['total'], 2);
        }

        return Inertia::render('Cart/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $cartAdded = Cart::where('user_id', Auth::id())->exists();
                $productAdded = Cart::with('items')->whereHas('items', function (Builder $query) use ($request) {
                    $query->where('product_id', $request->product);
                })->where('user_id', Auth::id())->exists();

                if(!$cartAdded){
                    $cart = new Cart();
                    $cart->user_id = Auth::id();
                    $cart->save();

                    $item = new CartItem();
                    $item->cart_id = $cart->id;
                    $item->product_id = $request->product;
                    $item->quantity = 1;
                    $item->save();
                } else if ($cartAdded && !$productAdded) {
                    $item = new CartItem();
                    $item->cart_id = Cart::where('user_id', Auth::id())->first()->id;
                    $item->product_id = $request->product;
                    $item->quantity = 1;
                    $item->save();
                }else {
                    $item = CartItem::select('id', 'quantity')->where('cart_id', Cart::where('user_id', Auth::id())->first()->id)->where('product_id', $request->product)->first();
                    $item->increment('quantity', 1);
                    $item->save();
                }

                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'store',
                    'module' => 'cart',
                    'description' => 'add product ID '.$request->product.' to cart',
                ]);
            });

            return Redirect::to('/products')->with('success', 'Product added to cart.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return Redirect::to('/products')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
