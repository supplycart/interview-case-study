<?php

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

// Test retrieving order history
it('can fetch order history', function () {
    // Create a user
    $user = User::factory()->create();

    // Create a product
    $product = Product::factory()->create(['price' => 100, 'stock' => 50]);

    // Create an order for the user
    $order = Order::factory()->create(['user_id' => $user->id, 'total_price' => 200]);

    // Create an order item associated with the order and product
    OrderItem::factory()->create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 2,
        'price' => 100, // Use the product price at the time of order
    ]);

    // Act as the user and request the order history
    $response = $this->actingAs($user)->getJson('/api/orders');

    // Assert the response is successful and the structure is correct
    $response->assertOk()
        ->assertJsonStructure([
            'orders' => [
                '*' => [
                    'id',
                    'total_price',
                    'items' => [
                        '*' => [
                            'id',
                            'product_id',
                            'quantity',
                            'price',
                            'product' => [
                                'id',
                                'name',
                                'price',
                            ],
                        ],
                    ],
                ],
            ],
        ])
        ->assertJsonFragment([
            'id' => $order->id,
            'total_price' => 200,
        ]);
});

// Test order creation
it('can create an order with items', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);

    // Act as the user and create an order
    $response = $this->actingAs($user)->postJson('/api/orders', [
        'items' => [
            ['product_id' => $product->id, 'quantity' => 2],
        ],
    ]);

    // Ensure the response is successful and the order is created
    $response->assertOk()
        ->assertJson([
            'message' => 'Order created successfully',
        ]);
});
