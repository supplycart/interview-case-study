<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityLogs = ActivityLog::where('user_id', auth()->id())->orderByDesc('id')->paginate(15);

        return view('activity-logs.index', compact('activityLogs'));
    }
}
