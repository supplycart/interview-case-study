<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserController\IndexRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $relationships = ['country'];
        if (isset($validated['logs']) && $validated['logs']) {
            $relationships[] = 'logs';
        }

        return $this->respond(
            message: 'Get user detail successful.',
            data: new UserResource(auth()->user()->load($relationships))
        );
    }

    public function store(Request $request)
    {
    }

    public function show(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
