<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create();
    }

    /** @test */
    public function it_can_checkout_and_get_order()
    {
        $this->actingAs($this->user);

        // Simulate adding product to cart
        $response = $this->post('/cart/add/'.$this->product->id, [
            'quantity' => 1,
        ]);

        $response->assertStatus(200);

        $responseCheckout = $this->post('/cart/checkout/');
        $responseCheckout->assertStatus(200);

        // Check if the product is in the cart
        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
        ]);
    }
}
