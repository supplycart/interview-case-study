<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthController\LoginRequest;
use App\Http\Requests\Api\AuthController\RegisterRequest;
use App\Http\Requests\Api\AuthController\VerifyEmailRequest;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);

        $user = new User();
        $user->fill($validated);
        $user->save();

        Cart::create(['user_id' => $user->id]);

        event(new Registered($user));

        return $this->respond('User registered successfully.', 201);
    }

    public function verifyEmail(VerifyEmailRequest $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return $this->respond('Email already verified.', 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->respond('Email verified successfully.');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $validated = $request->validated();
        try {
            $response = Http::post(config('app.url') . '/oauth/token', [
                'grant_type' => $validated['grant_type'],
                'client_id' => $validated['client_id'],
                'client_secret' => $validated['client_secret'],
                'username' => $validated['email'],
                'password' => $validated['password'],
                'scope' => '',
            ]);

            if ($response->successful()) {
                $user = $request->user()->load('country');
                $user->oauth = $response->json();
                return $this->respond('Logged in successfully.', 200, new UserResource($user));
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }

        return $this->respond($e ?? 'Internal Server Error', 500);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()?->revoke();
        return $this->respond('Logged out successfully.');
    }
}
