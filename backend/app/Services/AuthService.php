<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered; // For email verification
use App\Events\UserLoggedIn;           // For activity logging
use App\Events\UserLoggedOut;          // For activity logging
use Illuminate\Http\Request;           // To get IP and User Agent

class AuthService
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Dispatch event for email verification (Bonus)
        event(new Registered($user));

        // Activity logging will be handled by listeners attached to Sanctum/Fortify events
        // or could also dispatch a custom 'UserRegistered' event here for logging.

        return $user;
    }

    /**
     * Attempt to log in a user.
     *
     * @param array $credentials
     * @param Request $request
     * @return User|null The authenticated user or null on failure.
     */
    public function loginUser(array $credentials, Request $request): ?User
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        /** @var User $user */
        $user = Auth::user();

        // Dispatch event for activity logging (Bonus)
        event(new UserLoggedIn($user, $request->ip(), $request->userAgent()));

        return $user;
    }

    /**
     * Log out the current user.
     *
     * @param Request $request
     * @return void
     */
    public function logoutUser(Request $request): void
    {
        /** @var User $user */
        $user = $request->user();

        // Dispatch event for activity logging (Bonus)
        event(new UserLoggedOut($user, $request->ip(), $request->userAgent()));

        // Revoke the current token
        $user->currentAccessToken()->delete();
    }

    /**
     * Get the currently authenticated user.
     *
     * @param Request $request
     * @return User|null
     */
    public function getAuthenticatedUser(Request $request): ?User
    {
        // Type hint to User as middleware ensures it's authenticated
        /** @var User $user */
        $user = $request->user();
        return $user;
    }
}
