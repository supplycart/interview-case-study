<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->all());
            return response($user, 201);
        } catch (\Exception $e) {
            return response([
                "code" => "UC002",
                "error" => "Unable to add user email has already been taken",
            ], 400);
        }
    }

    // upgrade customer to member
    public function upgrade(Request $request) {
        $user = Auth::user();
        if ($user->role == 2) {
            return response([
                "code" => "UC003",
                "error" => "This user is already a member, can't be upgraded further,"
            ], 400);
        }
        $user->role = 2;
        $user->save();
        UserHistory::create([
            "type" => 7,
            "user_id" => $user->id
        ]);
        return response($user, 200);
    }

    public function histories() {
        $user = Auth::user();
        return response($user->histories(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
