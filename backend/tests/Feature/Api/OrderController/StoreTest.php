<?php

use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\postJson;

describe('Create An Order', function () {
    test('unauthenticated request', function () {
        postJson('api/orders')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('cannot create an order with empty cart', function () {
        $user = User::where('email', 'hazim.hadis+id@gmail.com')->first();
        Passport::actingAs($user);

        postJson('api/orders')
            ->assertStatus(400)
            ->assertJson(['message' => 'Cart is empty.']);
    });

    test('can create an order', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        assertDatabaseCount('cart_items', 2);
        assertDatabaseCount('orders', 2);
        assertDatabaseCount('order_items', 4);

        $country = getUserCountry();
        $cart = getUserCart();

        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price->amount * $item->quantity;
        }

        $response = postJson('api/orders')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'number',
                    'currency',
                    'tax_name',
                    'tax_rate',
                    'total',
                    'tax_amount',
                    'total_payable',
                    'items' => [
                        '*' => [
                            'product_id',
                            'product_name',
                            'brand_name',
                            'category_name',
                            'price_amount',
                            'quantity',
                            'total',
                        ],
                    ],
                ],
            ])
            ->assertJson([
                'message' => 'Create order successful.',
                'data' => [
                    'number' => getOrderRunningNumber(false),
                    'currency' => $country->currency,
                    'tax_name' => $country->tax_name,
                    'tax_rate' => $country->tax_rate,
                    'total' => $total,
                    'tax_amount' => $total * $country->tax_rate / 100,
                    'total_payable' => $total + ($total * $country->tax_rate / 100),
                    'items' => [
                        [
                            'product_id' => $cart->items[0]->product_id,
                            'product_name' => $cart->items[0]->product->name,
                            'brand_name' => $cart->items[0]->product->brand->name,
                            'category_name' => $cart->items[0]->product->category->name,
                            'price_amount' => $cart->items[0]->product->price->amount,
                            'quantity' => $cart->items[0]->quantity,
                            'total' => $cart->items[0]->product->price->amount * $cart->items[0]->quantity,
                        ],
                        [
                            'product_id' => $cart->items[1]->product_id,
                            'product_name' => $cart->items[1]->product->name,
                            'brand_name' => $cart->items[1]->product->brand->name,
                            'category_name' => $cart->items[1]->product->category->name,
                            'price_amount' => $cart->items[1]->product->price->amount,
                            'quantity' => $cart->items[1]->quantity,
                            'total' => $cart->items[1]->product->price->amount * $cart->items[1]->quantity,
                        ],
                    ],
                ],
            ]);

        assertDatabaseCount('cart_items', 0);
        assertDatabaseCount('orders', 3);
        assertDatabaseCount('order_items', 6);

        assertDatabaseMissing('cart_items', ['cart_id' => $cart->id]);
        assertDatabaseHas('orders', ['user_id' => $user->id]);
        assertDatabaseHas('order_items', ['order_id' => $response->json('data.id')]);
    });
});
