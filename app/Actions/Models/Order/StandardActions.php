<?php

namespace App\Actions\Models\Order;

use App\Models\Order;

class StandardActions
{
    public static function index($request)
    {
        if (!isset($request))
        {
            return Order::paginate();
        }

        $search = $request['search'];
        $filters = $request['filters'];

        $orders = Order::model();

        if (isset($filters) && !empty($filters))
        {
            $orders->query()
                ->when(isset($filters['number']), function($subquery) use ($filters) { $subquery->where('name', $filters['number']); })
                ->when(isset($filters['name']), function($subquery) use ($filters) { $subquery->where('name', $filters['name']); })
                ->when(isset($filters['email']), function($subquery) use ($filters) { $subquery->where('email', $filters['email']); })
                ->when(isset($filters['phone_no']), function($subquery) use ($filters) { $subquery->where('name', $filters['phone_no']); })
                ->when(isset($filters['date']), function($subquery) use ($filters) { $subquery->whereDate('created_at', $filters['date']); })
                ;
        }

        if (isset($search))
        {
            $orders->query()
                ->where('number', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone_no', 'like', "%{$search}%")
                ->orWhere('date', 'like', "%{$search}%")
                ;
        }

        return $orders->paginate();
    }

    public static function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        return $order;
    }

    public static function store($request)
    {
        // TODO: to complete later
        $orderRequest = [];
        $orderRequest['user_id'] = $request['user_id'];
        $orderRequest['number'] = CustomActions::generateDocumentNumber($request['user_id']);
        $orderRequest['subtotal'] = $request['subtotal'];
        $orderRequest['discount_amount'] = $request['discount_amount'];
        $orderRequest['grand_total'] = $request['grand_total'];

        $order = Order::create($request);

        return $order;
    }

    public static function update($id, $request)
    {
        $order = Order::findOrFail($id);
        $order = $order->update($request);

        return $order;
    }

    public static function delete($id)
    {
        $order = Order::findOrFail($id);
        $order = $order->delete();

        return $order;
    }
}
