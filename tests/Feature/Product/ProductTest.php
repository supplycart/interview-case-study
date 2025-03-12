<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('product page cannot be rendered without login', function () {
    $response = $this->get('user/product');

    // 302 because upon access the route, it will redirect to login page
    $response->assertStatus(302);
});

test('product page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();

    $response = $this->get('user/product');

    $response->assertStatus(200);
});


test('product can be created', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();

    $category = Category::create([ 'name' => 'Category A', 'position' => 1 ]);

    $product = Product::create([
        'category_id' => $category->id,
        'title' => 'Product A',
        'description' => 'Product Description',
        'base_price' => 5.99,
        'discounted_price_for_member' => 4.99,
    ]);

    $this->assertJson($product);
});
