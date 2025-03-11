<?php

namespace App\Http\Controllers\Web\User;

use App\Actions\Modules\General\ActivityLog\GetListingAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ActivityLogController extends Controller
{
    public static function index()
    {
        $user = Auth::user();

        $activityLogs = GetListingAction::execute($user);

        $props = [];
        $props['activity_logs'] = $activityLogs;

        return Inertia::render('user/activity-log/Index', $props);
    }
}
