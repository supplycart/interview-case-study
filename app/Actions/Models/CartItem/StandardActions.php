<?php

namespace App\Actions\Models\CartItem;

use App\Models\CartItem;

class StandardActions
{
    public static function index($request)
    {
        if (!isset($request))
        {
            return CartItem::paginate();
        }

        $cartItems = CartItem::query();

        if (isset($request['filters']) && !empty($request['filters']))
        {
            $filters = $request['filters'];

            $cartItems
                ->when(isset($filters['user_id']), function($subquery) use ($filters) { $subquery->where('user_id', $filters['user_id']); })
                ->when(isset($filters['product_id']), function($subquery) use ($filters) { $subquery->where('product_id', $filters['product_id']); })
                ;
        }

        if (isset($request['search']))
        {
            $search = $request['search'];

            $cartItems
                ->where('product_title', 'like', "%{$search}%")
                ->orWhere('product_description', 'like', "%{$search}%")
                ;
        }

        return $cartItems->paginate();
    }

    public static function show($id)
    {
        $cartItem = CartItem::findOrFail($id);

        return $cartItem;
    }

    public static function store($request)
    {
        $cartItem = CartItem::create($request);

        return $cartItem;
    }

    public static function update($id, $request)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update($request);

        return $cartItem;
    }

    public static function delete($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem = $cartItem->delete();

        return $cartItem;
    }
}
