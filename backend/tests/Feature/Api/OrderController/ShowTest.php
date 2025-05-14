<?php

use App\Models\Order;
use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\getJson;

describe('Get An Order', function () {
    test('unauthenticated request', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        $orderId = Order::where('user_id', $user->id)->first()->id;

        getJson('api/orders/'.$orderId)
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('can get an order', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);
        $orderId = Order::where('user_id', $user->id)->first()->id;

        getJson('api/orders/'.$orderId)
            ->assertStatus(200)
            ->assertJsonCount(2, 'data.items')
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
            ]);
    });
});
