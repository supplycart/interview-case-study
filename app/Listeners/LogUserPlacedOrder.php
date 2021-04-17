<?php

namespace App\Listeners;

use App\Events\UserPlacedOrder;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserPlacedOrder
{
    /**
     * Handle the event.
     *
     * @param  UserPlacedOrder  $event
     * @return void
     */
    public function handle(UserPlacedOrder $event)
    {
        $order = $event->order;
        $user = $order->cart->user;

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => "Order Placed (ID {$order->id})",
        ]);
    }
}
