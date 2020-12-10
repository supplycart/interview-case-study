<?php

namespace App\Listeners;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class RemoveCachePreviousDeliveryOrders
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        Cache::forget(Order::getCacheKeyForUser());
    }
}
