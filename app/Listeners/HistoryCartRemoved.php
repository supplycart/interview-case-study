<?php

namespace App\Listeners;

use App\Events\CartRemoved;
use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class HistoryCartRemoved
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
     * @param  CartRemoved  $event
     * @return void
     */
    public function handle(CartRemoved $event)
    {
        {
            History::create([
                'user_id' => $this->user->id,
                'event' => 'Removed Item to Cart',
                'metadata' => "Product Name: {$event->product->name}"
            ]);
        }
    }
}
