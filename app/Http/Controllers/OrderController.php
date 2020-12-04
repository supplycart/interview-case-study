<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderCreateRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrderController extends Controller
{
    public function index()
    {
        return Order::paginate(20);
    }

    public function store(OrderCreateRequest $request)
    {
        $order = Order::create();

        if (!$order instanceof Order) return;

        $totalPrices = [];

        // add all ordered products to an order
        foreach ($request->validated()['products'] as $product) {
            $totalPrice = $product['amount'] * $product['price'];

            $order->products()->attach(
                [$product['id'] => array_merge([
                    'total_price' => $totalPrice
                ], Arr::only($product, ['amount', 'price']))]);

            array_push($totalPrices, $totalPrice);
        }

        $order->update([
            'total_price' => collect($totalPrices)->sum()
        ]);
    }

    public function show(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
