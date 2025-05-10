<?php

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use function Pest\Laravel\getJson;

describe('Email Verification', function () {
    test('successfully verifies email with valid signature', function () {
        $user = User::factory()->create([
            'name' => 'Hazim',
            'email' => 'hazim.hadis+verify@gmail.com',
            'password' => 'password',
            'country_id' => Country::where('code', 'MY')->first()->id,
            'email_verified_at' => null,
        ]);
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification())
            ]
        );

        getJson($verificationUrl)
            ->assertStatus(200)
            ->assertJson(['message' => 'Email verified successfully.']);
    });

    test('rejects verification for already verified email', function () {
        $user = User::first();
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification())
            ]
        );

        getJson($verificationUrl)
            ->assertStatus(400)
            ->assertJson(['message' => 'Email already verified.']);
    });
});
