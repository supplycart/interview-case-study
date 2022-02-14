<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $trail = \OwenIt\Auditing\Models\Audit::with('user')->orderBy('created_at', 'desc')->get();
        return view('trail',compact('trail'));
    }
}
