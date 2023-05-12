<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\CartItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $cart = CartItem::where('id', $id)->first();
                $cart->delete();

                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'delete',
                    'module' => 'cart',
                    'description' => 'delete product ID '.$id.' from cart',
                ]);
            });

            return Redirect::to('/carts')->with('success', 'Product deleted from cart.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return Redirect::to('/carts')->with('error', 'Something went wrong.');
        }
    }
}
