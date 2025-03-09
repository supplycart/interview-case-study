<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public static function index()
    {
        return Inertia::render('Dashboard');
    }
}
