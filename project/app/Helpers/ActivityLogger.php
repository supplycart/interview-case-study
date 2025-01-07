<?php

// app/Helpers/ActivityLogger.php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log($user, $activity, $details = '')
    {
        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => $activity,
            'details' => $details,
        ]);
    }
}
