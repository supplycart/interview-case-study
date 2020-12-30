<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class HistoryOrderPlaced
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Handle the event.
     *
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        $product_list = $event->order->products->pluck('name');
        $product_names = implode(",", $product_list->all());
        History::create([
            'user_id' => $this->user->id,
            'event' => 'Placed Order',
            'metadata' => "Products: {$product_names}"
        ]);
    }
}
