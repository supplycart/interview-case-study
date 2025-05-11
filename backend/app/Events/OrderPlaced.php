<?php

namespace App\Events;

use App\Models\Order;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Order $order;
    public User $user;
    public ?string $ipAddress;
    public ?string $userAgent;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param User $user
     * @param string|null $ipAddress
     * @param string|null $userAgent
     */
    public function __construct(Order $order, User $user, ?string $ipAddress, ?string $userAgent)
    {
        $this->order = $order;
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }
}
