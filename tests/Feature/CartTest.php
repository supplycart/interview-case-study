<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_cart_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/carts');

        $response->assertStatus(200);
    }
    public function test_cart_can_be_added(): void
    {
        $user = User::factory()->create();
        Product::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/carts', [
                'product' => 1,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/products')
            ->assertSessionHas('success', 'Product added to cart.');
    }
}
