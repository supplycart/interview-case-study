<?php

namespace App\Listeners;

use App\Events\ProductAddedToCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogCartProduct
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

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductAddedToCart $event)
    {
        $log = $event->quantity
            ? sprintf('Cart updated: %s => %s', $event->quantity['before'] ?? 0, $event->quantity['after'] ?? 0)
            : 'Added to cart';

        activity()
            ->useLog('app')
            ->performedOn($event->product)
            ->log($log);
    }
}
