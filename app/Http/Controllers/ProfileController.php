<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with('rank')->findOrFail($request->user()->id);
        $ranks = Rank::all();

        return Inertia::render('Profile', [
            'user' => $user,
            'ranks' => $ranks
        ]);
    }

    public function upgrade(Request $request)
    {
        $user = $request->user();
        $validated_data = $request->validate([
            'rank_id' => 'required|numeric'
        ]);

        $user->rank_id = $validated_data['rank_id'];
        $user->save();

        return response()->json($user->fresh()->with('rank'));
    }
}
