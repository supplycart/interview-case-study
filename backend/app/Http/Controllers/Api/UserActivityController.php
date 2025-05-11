<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserActivityService;
use App\Http\Resources\UserActivityLogCollection; // Custom collection resource for logs
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    protected UserActivityService $userActivityService;

    public function __construct(UserActivityService $userActivityService)
    {
        $this->userActivityService = $userActivityService;
    }

    /**
     * Display a listing of the authenticated user's activity.
     */
    public function index(Request $request): UserActivityLogCollection
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $perPage = (int) $request->query('per_page', 15);

        $logs = $this->userActivityService->getUserActivityLogs($user, $perPage);
        return new UserActivityLogCollection($logs);
    }

    /**
     * (Admin Only - Example) Display a listing of all user activities.
     * This would need admin authorization middleware.
     */
    // public function allLogs(Request $request): UserActivityLogCollection
    // {
    //     // Add admin check here: if (! $request->user()->isAdmin()) { abort(403); }
    //     $perPage = (int) $request->query('per_page', 15);
    //     $filters = $request->only(['action', 'user_id']); // Example filters
    //     $logs = $this->userActivityService->getAllActivityLogs($perPage, $filters);
    //     return new UserActivityLogCollection($logs);
    // }
}
