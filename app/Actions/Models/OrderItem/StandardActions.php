<?php

namespace App\Actions\Models\OrderItem;

use App\Models\OrderItem;

class StandardActions
{
    public static function index($order_id)
    {
        $orderItems = OrderItem::where('order_id', $order_id);

        return $orderItems->paginate();
    }

    public static function show($id)
    {
        $orderItem = OrderItem::findOrFail($id);

        return $orderItem;
    }

    public static function store($request)
    {
        $orderItem = OrderItem::create($request);

        return $orderItem;
    }

    public static function update($id, $request)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem = $orderItem->update($request);

        return $orderItem;
    }

    public static function delete($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem = $orderItem->delete();

        return $orderItem;
    }
}
