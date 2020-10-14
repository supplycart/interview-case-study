<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * Negative Case: Get products
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_unauthenticated_user()
    {
        $response = $this->getJson('/api/products');
        $response->assertStatus(401); //unauthenticated
    }

    /**
     * Positive Case: Get products
     * Expected: Return Products
     * @test
     */
    public function positive_case_authenticated_user()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['products']
        );
        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
    }




}
