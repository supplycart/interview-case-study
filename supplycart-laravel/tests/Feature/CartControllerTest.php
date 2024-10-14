<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

// Test fetching cart
it('can fetch user cart', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['price' => 854.05]);

    // Create a cart for the user
    $cart = Cart::factory()->create(['user_id' => $user->id]);
    CartItem::factory()->create(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 2]);

    // Send request to fetch the cart
    $response = $this->actingAs($user)->getJson('/api/cart');

    $response->assertOk()
        ->assertJsonStructure([
            'items' => [
                '*' => ['id', 'product_id', 'quantity', 'subtotal', 'product' => ['id', 'name', 'description', 'price', 'brand']],
            ],
        ])
        ->assertJson([
            'user_id' => $user->id,
            'total_price' => 0, // Total price is 0 by default since there's no cart items selected
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'subtotal' => $product->price * 2, // Ensure subtotal is correct
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => (string) $product->price, // Handle price as string
                        'brand' => null,
                    ],
                ],
            ],
        ]);
});

// Test adding to cart
it('can add item to cart', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    // Send request to add item to cart
    $response = $this->actingAs($user)->postJson('/api/cart', [
        'product_id' => $product->id,
        'quantity' => 1,
    ]);

    $response->assertOk()
        ->assertJson([
            'message' => 'Product added to cart successfully.',
        ]);
});
