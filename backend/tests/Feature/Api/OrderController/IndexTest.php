<?php

use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\getJson;

describe('Get All Orders', function () {
    test('unauthenticated request', function () {
        getJson('api/orders')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('can get all orders', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/orders')
            ->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'message',
                'data' => [
                    '*' => [
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
                    ]
                ]
            ])
            ->assertJsonPath('meta.total', 2)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('links.first', config('app.url').'/api/orders?page=1')
            ->assertJsonPath('links.last', config('app.url').'/api/orders?page=1')
            ->assertJsonPath('links.prev', null)
            ->assertJsonPath('links.next', null);
    });

    test('get 1 order only per page', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/orders?limit=1')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('meta.total', 2)
            ->assertJsonPath('meta.per_page', 1)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('links.first', config('app.url').'/api/orders?page=1')
            ->assertJsonPath('links.last', config('app.url').'/api/orders?page=2')
            ->assertJsonPath('links.prev', null)
            ->assertJsonPath('links.next', config('app.url').'/api/orders?page=2');
    });

    test('get 2nd page where 1 order only per page', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/orders?limit=1&page=2')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('meta.total', 2)
            ->assertJsonPath('meta.per_page', 1)
            ->assertJsonPath('meta.current_page', 2)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('links.first', config('app.url').'/api/orders?page=1')
            ->assertJsonPath('links.last', config('app.url').'/api/orders?page=2')
            ->assertJsonPath('links.prev', config('app.url').'/api/orders?page=1')
            ->assertJsonPath('links.next', null);
    });
});
