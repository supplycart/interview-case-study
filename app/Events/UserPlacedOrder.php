<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserPlacedOrder
{
    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order->load([
            'cart' => function ($query) {
                return $query->with('user');
            }
        ]);
    }
}
