<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLog;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function getProfile(Request $request){
        dd($request);
    }

    public function getActivity(){
        try {
            $logs = UserLog::where('user_id', Auth::user()->id)->get();

            return response()->json(['data' => $logs], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 400);
        }     
    }
}
