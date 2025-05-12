<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\getJson;

describe('Get Cart', function () {
    test('unauthenticated request', function () {
        getJson('api/carts')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('get empty user cart', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/carts')
            ->assertStatus(200)
            ->assertJsonCount(0, 'data.items')
            ->assertJsonStructure([
                'message',
                'data' => [
                    'items' => [],
                ],
            ]);
    });

    test('get not empty user cart', function () {
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

        getJson('api/carts')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data.items')
            ->assertJsonStructure([
                'message',
                'data' => [
                    'items' => [
                        '*' => [
                            'product_id',
                            'quantity',
                            'product' => [
                                'id',
                                'name',
                                'description',
                                'brand' => [
                                    'id',
                                    'name',
                                ],
                                'category' => [
                                    'id',
                                    'name',
                                ],
                                'price',
                            ],
                        ],
                    ],
                ],
            ]);
    });
});
