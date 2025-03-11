<?php

namespace App\Actions\Modules\General\ActivityLog;

use App\Actions\Models\ActivityLog\StandardActions as ActivityLogStandardActions;
use App\Models\User;

class GetListingAction
{
    public static function execute($user, $request = [])
    {
        $request['filters'] = [];
        $request['filters']['causer_id'] = $user->id;
        $request['filters']['causer_type'] = User::class;

        $activityLogs = ActivityLogStandardActions::index($request);

        return $activityLogs;
    }
}
