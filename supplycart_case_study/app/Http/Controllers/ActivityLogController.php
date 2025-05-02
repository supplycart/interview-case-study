<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = Activity::with('causer')
            ->latest()
            ->take(100)
            ->get()
            ->map(fn ($log) => [
                'id' => $log->id,
                'user' => $log->causer?->name ?? 'System',
                'description' => $log->description,
                'created_at' => $log->created_at->format('d M Y, h:i A'),
                'properties' => $log->properties,
            ]);

        return Inertia::render('activityLog/Index', [
            'logs' => $logs,
        ]);
    }
}
