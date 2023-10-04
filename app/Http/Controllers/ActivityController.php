<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    function index() : Response {
        $activities = Activity::with('causer')->whereHas('causer', function ($causer) {
            $causer->where('id', auth()->user()->id);
        })->orderBy('id', 'desc')->paginate(10);

        return Inertia::render('Activity/Index', [
            'activities' => $activities,
            'carts_count' => auth()->user()->carts->count()
        ]);
    }
}
