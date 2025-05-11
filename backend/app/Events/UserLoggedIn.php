<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public ?string $ipAddress;
    public ?string $userAgent;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param string|null $ipAddress
     * @param string|null $userAgent
     */
    public function __construct(User $user, ?string $ipAddress, ?string $userAgent)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }
}
