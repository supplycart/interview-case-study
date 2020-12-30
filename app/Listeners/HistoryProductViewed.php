<?php

namespace App\Listeners;

use App\Events\ProductViewed;
use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class HistoryProductViewed
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
     * @param  ProductViewed  $event
     * @return void
     */
    public function handle(ProductViewed $event)
    {
        {
            History::create([
                'user_id' => $this->user->id,
                'event' => 'Viewed Item',
                'metadata' => "Product Name: {$event->product->name}"
            ]);
        }
    }
}
