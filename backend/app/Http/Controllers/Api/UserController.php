<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->respond(message: 'Get user list successful.', data: new UserCollection(User::all()));
    }

    public function store(Request $request)
    {
    }

    public function show(User $user): JsonResponse
    {
        return $this->respond(message: 'Get user detail successful.', data: new UserResource($user));
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
