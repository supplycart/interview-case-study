<?php

use App\Models\Product;
use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\getJson;

describe('Get A Product', function () {
    test('unauthenticated request', function () {
        getJson('api/products/1')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('can a product', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);
        $productId = Product::first()->id;

        getJson('api/products/'.$productId)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
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
            ]);
    });

    test('get a product with price according to user country', function (string $email, string $productName, ?int $price) {
        $user = User::where('email', $email)->first();
        Passport::actingAs($user);
        $productId = Product::where('name', $productName)->first()->id;

        getJson('api/products/'.$productId)
            ->assertStatus(200)
            ->assertJsonPath('data.name', $productName)
            ->assertJsonPath('data.price', $price);
    })->with([
        'Malaysia product 1' => ['hazim.hadis+my@gmail.com', 'Dash 125 / Supra X 125', 6599],
        'Indonesia product 1' => ['hazim.hadis+id@gmail.com', 'Dash 125 / Supra X 125', 20750_000],
        'Malaysia product 2' => ['hazim.hadis+my@gmail.com', '135LC', 8298],
        'Indonesia product 2' => ['hazim.hadis+id@gmail.com', '135LC', null],
        'Malaysia product 3' => ['hazim.hadis+my@gmail.com', 'Raider R150 / Satria F150', 8379],
        'Indonesia product 3' => ['hazim.hadis+id@gmail.com', 'Raider R150 / Satria F150', 29165000],
    ]);
});
