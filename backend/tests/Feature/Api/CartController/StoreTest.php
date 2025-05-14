<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\postJson;

describe('Update Cart', function () {
    test('unauthenticated request', function () {
        $data = [];

        postJson('api/carts', $data)
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('add items to cart', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        $productIds = Product::limit(3)->pluck('id')->toArray();
        $data = [
            ['product_id' => $productIds[0], 'quantity' => 1],
            ['product_id' => $productIds[1], 'quantity' => 2],
            ['product_id' => $productIds[2], 'quantity' => 3],
        ];

        postJson('api/carts', $data)
            ->assertStatus(200)
            ->assertJsonCount(3, 'data.items')
            ->assertJsonStructure([
                'message',
                'data' => [
                    'items' => [],
                ],
            ])
            ->assertJsonPath('data.items.0.product_id', $data[0]['product_id'])
            ->assertJsonPath('data.items.0.quantity', $data[0]['quantity'])
            ->assertJsonPath('data.items.1.product_id', $data[1]['product_id'])
            ->assertJsonPath('data.items.1.quantity', $data[1]['quantity'])
            ->assertJsonPath('data.items.2.product_id', $data[2]['product_id'])
            ->assertJsonPath('data.items.2.quantity', $data[2]['quantity']);
    });

    test('remove items in cart', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        $cartId = Cart::where('user_id', $user->id)->first()->id;
        $productIds = Product::limit(3)->pluck('id')->toArray();
        CartItem::factory()
            ->count(3)
            ->sequence(function ($sequence) use ($productIds) {
                return ['product_id' => $productIds[$sequence->index]];
            })
            ->create([
                'cart_id' => $cartId,
                'quantity' => 1,
            ]);

        $data = [];

        postJson('api/carts', $data)
            ->assertStatus(200)
            ->assertJsonCount(0, 'data.items')
            ->assertJsonStructure([
                'message',
                'data' => [
                    'items' => [],
                ],
            ]);
    });

    test('update items in cart', function () {
        $user = User::where('email', 'hazim.hadis+id@gmail.com')->first();
        Passport::actingAs($user);

        $cartId = Cart::where('user_id', $user->id)->first()->id;
        $productIds = Product::limit(3)->pluck('id')->toArray();
        CartItem::factory()
            ->count(3)
            ->sequence(function ($sequence) use ($productIds) {
                return ['product_id' => $productIds[$sequence->index]];
            })
            ->create([
                'cart_id' => $cartId,
                'quantity' => 1,
            ]);

        $data = [
            ['product_id' => $productIds[0], 'quantity' => 1],
            ['product_id' => $productIds[1], 'quantity' => 2],
            ['product_id' => $productIds[2], 'quantity' => 3],
        ];

        postJson('api/carts', $data)
            ->assertStatus(200)
            ->assertJsonCount(3, 'data.items')
            ->assertJsonStructure([
                'message',
                'data' => [
                    'items' => [],
                ],
            ])
            ->assertJsonPath('data.items.0.product_id', $data[0]['product_id'])
            ->assertJsonPath('data.items.0.quantity', $data[0]['quantity'])
            ->assertJsonPath('data.items.1.product_id', $data[1]['product_id'])
            ->assertJsonPath('data.items.1.quantity', $data[1]['quantity'])
            ->assertJsonPath('data.items.2.product_id', $data[2]['product_id'])
            ->assertJsonPath('data.items.2.quantity', $data[2]['quantity']);
    });
});
