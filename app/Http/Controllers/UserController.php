<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function activity()
    {
        return Inertia::render('User/Activity');
    }
}
