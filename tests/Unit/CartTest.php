<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create();
    }

    /** @test */
    public function it_can_add_product_to_cart()
    {
        $this->actingAs($this->user);

        // Simulate adding product to cart
        $response = $this->post('/cart/add/'.$this->product->id, [
            'quantity' => 1,
        ]);

        $response->assertStatus(200);
        // Check if the product is in the cart
        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function it_can_remove_product_from_cart()
    {
        $this->actingAs($this->user);

        // First, add the product to cart
        $this->post('/cart/add/'.$this->product->id, [
            'quantity' => 1,
        ]);

        // Now, remove the product from cart
        $response = $this->delete('/cart/remove/'.$this->product->id);

        $response->assertStatus(200);

        // Check if the user_id still exists but cart_items is an empty array or empty JSON
        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id, // Ensure user still has a cart
            'cart_items' => json_encode([]), // Ensure cart_items is an empty array or empty JSON
        ]);
    }
}
