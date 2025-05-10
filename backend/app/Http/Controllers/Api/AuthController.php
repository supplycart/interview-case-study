<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthController\LoginRequest;
use App\Http\Requests\Api\AuthController\RegisterRequest;
use App\Http\Requests\Api\AuthController\VerifyEmailRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);

        $user = new User();
        $user->fill($validated);
        $user->save();
        event(new Registered($user));

        return response()->json(['message' => 'User registered successfully.'], 201);
    }

    public function verifyEmail(VerifyEmailRequest $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified.'], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Email verified successfully.']);
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

            $user = $request->user()->toArray();
            $user['oauth'] = $response->json();
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Logged in successfully.',
                    'data' => $user,
                ]);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json(['Internal Server Error'], 500);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()?->revoke();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
