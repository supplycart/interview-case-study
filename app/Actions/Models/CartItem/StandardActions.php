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

            $cartItems->query()
                ->when(isset($filters['name']), function($subquery) use ($filters) { $subquery->where('name', $filters['name']); })
                ->when(isset($filters['email']), function($subquery) use ($filters) { $subquery->where('email', $filters['email']); })
                ->when(isset($filters['phone_no']), function($subquery) use ($filters) { $subquery->where('name', $filters['phone_no']); })
                ;
        }

        if (isset($request['search']))
        {
            $search = $request['search'];

            $cartItems->query()
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone_no', 'like', "%{$search}%")
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
        $cartItem = $cartItem->update($request);

        return $cartItem;
    }

    public static function delete($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem = $cartItem->delete();

        return $cartItem;
    }
}
