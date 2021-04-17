<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $logs = ActivityLog::all();

        return Inertia::render('Dashboard', [
            'orders' => $orders,
            'logs' => $logs,
        ]);
    }
}
