<?php

namespace App\Listeners\Order;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreaseOrderStock
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $order = $event->order;

        if (!$order instanceof Order) return;

        $addedProducts = $order->orderedProducts()
            ->with(['product'])
            ->get();

        $addedProducts->each(function($item) {
            $item->product->update([
               'stock' => $item->product->stock - $item['amount']
            ]);
        });

    }
}
