<?php

namespace App\Actions\Models\ActivityLog;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class StandardActions
{
    public static function index($request)
    {
        if (!isset($request))
        {
            return Activity::paginate();
        }

        $activityLogs = Activity::query();

        if (isset($request['filters']) && !empty($request['filters']))
        {
            $filters = $request['filters'];

            $activityLogs
                ->when(isset($filters['causer_type']), function($subquery) use ($filters) { $subquery->where('causer_type', $filters['causer_type']); })
                ->when(isset($filters['causer_id']), function($subquery) use ($filters) { $subquery->where('causer_id', $filters['causer_id']); })
                ;
        }

        if (isset($request['search']))
        {
            $search = $request['search'];

            $activityLogs
                ->where('description', 'like', "%{$search}%")
                ;
        }

        return $activityLogs->orderBy('id', 'desc')->paginate();
    }

    public static function show($id)
    {
        abort(404);
    }

    public static function store($request)
    {
        abort(404);
    }

    public static function update($id, $request)
    {
        abort(404);
    }

    public static function delete($id)
    {
        abort(404);
    }
}
