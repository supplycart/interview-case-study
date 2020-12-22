<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivitiesCollection;
use DB;
use Spatie\Activitylog\Models\Activity;
use Validator;

class ActivityController extends Controller
{

    public function index()
    {
        $activities = Activity::where(
            "causer_id",
            auth()->user()->id
        )->paginate(10);


        return response()->json(
            new ActivitiesCollection($activities)
        );
    }

}
