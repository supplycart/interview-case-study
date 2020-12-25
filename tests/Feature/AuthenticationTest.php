<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'register', ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    public function testRepeatPassword()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345"
        ];

        $this->json('POST', 'register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422);            
            
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ];

        $this->json('POST', 'register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201);
    }
}