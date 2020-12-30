<?php

namespace App\Listeners;

use App\Events\CartAdded;
use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class HistoryCartAdded
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
     * @param  CartAdded  $event
     * @return void
     */
    public function handle(CartAdded $event)
    {
        History::create([
            'user_id' => $this->user->id,
            'event' => 'Added Item to Cart',
            'metadata' => "Product Name: {$event->product->name}"
        ]);
    }
}
