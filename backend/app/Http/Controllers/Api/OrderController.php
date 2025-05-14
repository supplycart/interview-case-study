<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderController\IndexRequest;
use App\Http\Requests\Api\OrderController\StoreRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $orders = Order::query()
            ->with(['items'])
            ->where('user_id', auth()->id())
            ->paginate($validated['limit'] ?? 10);

        return $this->respond(
            message: 'Get order list successful.',
            data: new OrderCollection($orders)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): JsonResponse
    {
        $cart = getUserCart();

        if ($cart->items->isEmpty()) {
            return $this->respond(message: 'Cart is empty.',status: 400);
        }

        $country = getUserCountry();

        $order = New Order();
        $order->user_id = auth()->id();
        $order->number = getOrderRunningNumber();
        $order->currency = $country->currency;
        $order->tax_name = $country->tax_name;
        $order->tax_rate = $country->tax_rate;
        $order->save();

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'brand_name' => $item->product->brand->name,
                'category_name' => $item->product->category->name,
                'price_amount' => $item->product->price->amount,
                'quantity' => $item->quantity,
                'total' => $item->product->price->amount * $item->quantity,
            ]);
            $item->delete();
        }

        $order->total = $order->items->sum('total');
        $order->tax_amount = $order->total * $order->tax_rate / 100;
        $order->total_payable = $order->total + $order->tax_amount;
        $order->save();

        return $this->respond(
            message: 'Create order successful.',
            data: new OrderResource($order->load('items'))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): JsonResponse
    {
        return $this->respond(
            message: 'Get order detail successful.',
            data: new OrderResource($order->load('items'))
        );
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
        //
    }
}
