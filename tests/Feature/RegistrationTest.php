<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $tmp = (new UserFactory())->definition();
        $response = $this->post('/api/user',
            $tmp
        );

        $response->assertStatus(201);
        self::assertEquals($tmp["address"], User::where("email", $tmp['email'])->first()->address);
    }
}
