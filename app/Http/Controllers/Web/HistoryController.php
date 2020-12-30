<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $history = History::where('user_id', '=', $user->id);
        return view('app.history', ['histories' => $history->paginate(20)]);
    }
}
