<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;

class LogUserActivityListener
{
    /**
     * Handle the event.
     *
     * @param object $event The event instance (UserLoggedIn, OrderPlaced, etc.)
     */
    public function handle(object $event): void
    {
        try {
            $user = null;
            $actionDetails = [];

            // Extract user and specific details based on event type
            if (property_exists($event, 'user') && $event->user instanceof \App\Models\User) {
                $user = $event->user;
            }

            if ($event instanceof \App\Events\UserLoggedIn) {
                $action = 'user_logged_in';
            } elseif ($event instanceof \App\Events\UserLoggedOut) {
                $action = 'user_logged_out';
            } elseif ($event instanceof \App\Events\OrderPlaced) {
                $action = 'order_placed';
                if (property_exists($event, 'order') && $event->order instanceof \App\Models\Order) {
                    $actionDetails['order_id'] = $event->order->id;
                    $actionDetails['total_amount_in_cents'] = $event->order->total_amount_in_cents;
                }
            }

            if ($user) { // Only log if there's an associated user
                ActivityLog::create([
                    'user_id' => $user->id,
                    'action' => $action,
                    'details' => count($actionDetails) > 0 ? $actionDetails : null,
                    'ip_address' => property_exists($event, 'ipAddress') ? $event->ipAddress : request()->ip(),
                    'user_agent' => property_exists($event, 'userAgent') ? $event->userAgent : request()->userAgent(),
                    'logged_at' => now()
                ]);
            } else {
                Log::info("LogUserActivityListener: Event {$action} received without a user or user property not found.");
            }
        } catch (\Exception $e) {
            Log::error("Error in LogUserActivityListener: " . $e->getMessage(), [
                'event' => get_class($event),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
