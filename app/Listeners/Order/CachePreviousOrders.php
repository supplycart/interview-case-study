<?php

namespace App\Listeners\Order;

use App\Models\Order;
use App\Services\GetPreviousOrders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class CachePreviousOrders
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        Cache::forget(auth()->user()->id . Order::CACHE_NAME);
        GetPreviousOrders::index();
    }
}
