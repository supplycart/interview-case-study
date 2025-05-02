<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Str;

class OrderRepository implements OrderRepositoryInterface
{
    public function getUserOrders(int $userId): array
    {
        return Order::with(['products.product'])
            ->where('user_id', $userId)
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'receipt_no' => $order->receipt_no,
                    'total' => (float) $order->total,
                    'status' => $order->status,
                    'created_at' => $order->created_at->format('d M Y, h:i A'),
                    'products' => $order->products->map(function ($op) {
                        return [
                            'name' => $op->product->name,
                            'qty' => $op->qty,
                            'price' => (float) $op->price,
                            'total' => (float) $op->total,
                        ];
                    }),
                ];
            })
            ->toArray();
    }

    public function createOrder(int $userId, string $fullName, array $items): Order
    {
        $total = 0;
        $orderItems = [];

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $lineTotal = $product->price * $item['quantity'];
            $total += $lineTotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'qty' => $item['quantity'],
                'price' => $product->price,
                'total' => $lineTotal,
            ];
        }

        $order = Order::create([
            'user_id' => $userId,
            'receipt_no' => strtoupper(Str::random(10)),
            'total' => $total,
            'full_name' => $fullName,
            'status' => 'placed',
        ]);

        $order->products()->createMany($orderItems);

        return $order;
    }
}
