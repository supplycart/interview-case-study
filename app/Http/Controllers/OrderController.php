<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PreviousOrderResource;
use App\Models\AddedProduct;
use App\Models\Order;
use App\Models\ProductPrice;
use App\Services\GetPreviousOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrderController extends Controller
{
    public function index()
    {
        return GetPreviousOrders::index();
    }

    public function store(OrderCreateRequest $request)
    {
        $order = Order::create();

        if (!$order instanceof Order) return;

        $totalPrices = [];

        $prices = ProductPrice::whereIn('id', collect($request->validated()['products'])
            ->pluck('product_prices_id'))
            ->get();

        foreach ($request->validated()['products'] as $addedProduct) {
            $instance = AddedProduct::find($addedProduct['id']);
            $price = $prices->firstWhere('id', $addedProduct['product_prices_id'])['price'];
            $instance->update([
                'current_price' => $price,
                'order_id' => $order->id,
                'amount' => $addedProduct['amount'],
                'total' => $price * $addedProduct['amount']
            ]);
            array_push($totalPrices, $instance->total);
        }

        $order->update([
            'total_price' => collect($totalPrices)->sum()
        ]);

        event(new OrderPlaced($order));
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
