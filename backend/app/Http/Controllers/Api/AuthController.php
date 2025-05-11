<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Services\EmailVerificationService; // Bonus
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest as LaravelEmailVerificationRequest; // Bonus
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    protected AuthService $authService;
    protected EmailVerificationService $emailVerificationService; // Bonus

    public function __construct(AuthService $authService, EmailVerificationService $emailVerificationService)
    {
        $this->authService = $authService;
        $this->emailVerificationService = $emailVerificationService; // Bonus
    }

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->registerUser($request->validated());

        return response()->json([
            'message' => 'User registered successfully. Please check your email to verify your account.', // Bonus
            'user' => new UserResource($user),
            // 'token' => $token, // Token not needed since verification is required before login
        ], 201);
    }

    /**
     * Log in an existing user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->loginUser($request->validated(), $request);

        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Bonus: Check for email verification
        if (!$user->hasVerifiedEmail() && config('auth.must_verify_email', true)) {
            // Log out user if login was successful but email not verified
            $this->authService->logoutUser($request); // Revoke temporary session/token
            return response()->json([
                'message' => 'Please verify your email address before logging in.',
                'email_not_verified' => true
            ], 403); // Forbidden
        }

        $token = $user->createToken('authToken-' . $user->id)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    /**
     * Log out the current user.
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logoutUser($request);
        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Get the authenticated user's information.
     */
    public function user(Request $request): UserResource
    {
        $user = $this->authService->getAuthenticatedUser($request);
        return new UserResource($user);
    }

    /**
     * Mark the authenticated user's email address as verified. (Bonus)
     * Route: GET /api/email/verify/{id}/{hash} (name: verification.verify)
     */
    public function verifyEmail(LaravelEmailVerificationRequest $request): RedirectResponse
    {
        $userId = $request->route('id');
        // The LaravelEmailVerificationRequest itself handles the signed URL logic and user loading.
        $verified = $this->emailVerificationService->verifyEmail($userId);

        if ($verified) {
            // Redirect to a frontend page indicating success
            return redirect(config('app.frontend_url') . '/email-verified?success=true');
        }
        return redirect(config('app.frontend_url') . '/email-verified?already_verified=true');
    }

    /**
     * Resend the email verification notification. (Bonus)
     * Route: POST /api/email/verification-notification (name: verification.send)
     */
    public function resendVerificationEmail(Request $request): JsonResponse
    {
        $sent = $this->emailVerificationService->resendVerificationNotification($request);

        if ($sent) {
            return response()->json(['message' => 'Verification link sent!']);
        }
        return response()->json(['message' => 'Email already verified.'], 400);
    }
}
