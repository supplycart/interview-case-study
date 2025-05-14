<?php

use App\Models\Country;
use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

describe('User Registration', function () {
    test('can register a new user', function () {
        $data = [
            'name' => 'Hazim',
            'email' => 'hazim.hadis+register@gmail.com',
            'password' => 'password',
            'country_id' => Country::where('code', 'MY')->first()->id,
        ];

        postJson('/api/register', $data)
            ->assertStatus(201)
            ->assertJsonStructure(['message'])
            ->assertJson(['message' => 'User registered successfully.']);

        assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        assertDatabaseHas('carts', [
            'user_id' => $user->id,
        ]);
    });

    test('register with validation errors', function (string $email, string $password = 'password') {
        $data = [
            'name' => 'Hazim',
            'email' => $email,
            'password' => $password,
            'country_id' => Country::where('code', 'MY')->first()->id,
        ];

        postJson('/api/register', $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(
                strlen($password) < 8 ? ['password'] : ['email']
            );

        assertDatabaseCount('users', 2);
    })->with([
        'existing email' => ['hazim.hadis+my@gmail.com'],
        'invalid email format' => ['hazim.hadis+register@g.c'],
        'short password' => ['hazim.hadis+register@gmail.com', 'pass']
    ]);
});
