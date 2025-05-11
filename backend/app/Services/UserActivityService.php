<?php

namespace App\Services;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserActivityService
{
    /**
     * Get paginated activity logs for a specific user.
     *
     * @param User $user
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserActivityLogs(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return ActivityLog::where('user_id', $user->id)
            ->orderBy('logged_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get all activity logs (typically for an admin).
     *
     * @param int $perPage
     * @param array $filters (e.g., filter by action, date range)
     * @return LengthAwarePaginator
     */
    public function getAllActivityLogs(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = ActivityLog::with('user:id,name,email') // Eager load user info
            ->orderBy('logged_at', 'desc');

        if (!empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
        // Add date range filters etc.

        return $query->paginate($perPage);
    }
}
