<?php

use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\getJson;

describe('Get All Products', function () {
    test('unauthenticated request', function () {
        getJson('api/products')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    });

    test('can get all products', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/products')
            ->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'message',
                'data' => [
                    '*' => [
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
                    ]
                ],
                'meta',
                'links',
            ])
            ->assertJsonPath('meta.total', 10)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('links.first', config('app.url').'/api/products?page=1')
            ->assertJsonPath('links.last', config('app.url').'/api/products?page=1')
            ->assertJsonPath('links.prev', null)
            ->assertJsonPath('links.next', null);
    });

    test('get products with price according to user country', function (string $email, ?int $price1, ?int $price2, ?int $price3) {
        $user = User::where('email', $email)->first();
        Passport::actingAs($user);

        getJson('api/products')
            ->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJsonPath('data.0.name', 'Dash 125 / Supra X 125')
            ->assertJsonPath('data.0.brand.name', 'Honda')
            ->assertJsonPath('data.0.category.name', 'Moped')
            ->assertJsonPath('data.0.price', $price1)
            ->assertJsonPath('data.4.name', '135LC')
            ->assertJsonPath('data.4.brand.name', 'Yamaha')
            ->assertJsonPath('data.4.category.name', 'Moped')
            ->assertJsonPath('data.4.price', $price2)
            ->assertJsonPath('data.8.name', 'Raider R150 / Satria F150')
            ->assertJsonPath('data.8.brand.name', 'Suzuki')
            ->assertJsonPath('data.8.category.name', 'Moped')
            ->assertJsonPath('data.8.price', $price3);
    })->with([
        'Malaysia' => ['hazim.hadis+my@gmail.com', 6599, 8298, 8379],
        'Indonesia' => ['hazim.hadis+id@gmail.com', 20750_000, null, 29165000],
    ]);

    test('get searched products', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/products?search=150')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonPath('data.0.name', 'RS150R / RS-X / Supra GTR 150')
            ->assertJsonPath('data.0.brand.name', 'Honda')
            ->assertJsonPath('data.1.name', 'Y15ZR / Sniper 150 / MX King / Exciter 150')
            ->assertJsonPath('data.1.brand.name', 'Yamaha')
            ->assertJsonPath('data.2.name', 'Raider R150 / Satria F150')
            ->assertJsonPath('data.2.brand.name', 'Suzuki');
    });

    test('get filtered products by brand', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/products?filter[brand_id]=1')
            ->assertStatus(200)
            ->assertJsonCount(4, 'data')
            ->assertJsonPath('data.0.brand.name', 'Honda')
            ->assertJsonPath('data.1.brand.name', 'Honda')
            ->assertJsonPath('data.2.brand.name', 'Honda')
            ->assertJsonPath('data.3.brand.name', 'Honda');
    });

    test('get filtered products by category', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/products?filter[category_id]=1')
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('data.0.category.name', 'Moped')
            ->assertJsonPath('data.1.category.name', 'Moped')
            ->assertJsonPath('data.2.category.name', 'Moped')
            ->assertJsonPath('data.3.category.name', 'Moped')
            ->assertJsonPath('data.4.category.name', 'Moped');
    });

    test('get 5 products only per page', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/products?limit=5')
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('meta.total', 10)
            ->assertJsonPath('meta.per_page', 5)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('links.first', config('app.url').'/api/products?page=1')
            ->assertJsonPath('links.last', config('app.url').'/api/products?page=2')
            ->assertJsonPath('links.prev', null)
            ->assertJsonPath('links.next', config('app.url').'/api/products?page=2');
    });

    test('get 2nd page where 5 products only per page', function () {
        $user = User::where('email', 'hazim.hadis+my@gmail.com')->first();
        Passport::actingAs($user);

        getJson('api/products?limit=5&page=2')
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('meta.total', 10)
            ->assertJsonPath('meta.per_page', 5)
            ->assertJsonPath('meta.current_page', 2)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('links.first', config('app.url').'/api/products?page=1')
            ->assertJsonPath('links.last', config('app.url').'/api/products?page=2')
            ->assertJsonPath('links.prev', config('app.url').'/api/products?page=1')
            ->assertJsonPath('links.next', null);
    });
});
