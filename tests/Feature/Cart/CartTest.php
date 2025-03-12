<?php

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('cart page cannot be rendered without login', function () {
    $response = $this->get('user/cart');

    // 302 because upon access the route, it will redirect to login page
    $response->assertStatus(302);
});

test('cart page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();

    $response = $this->get('user/cart');

    $response->assertStatus(200);
});


test('user able to add to cart', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();

    $response = $this->get('user/cart');

    $response->assertStatus(200);

    $category = Category::create([ 'name' => 'Category A', 'position' => 1 ]);

    $product = Product::create([
        'category_id' => $category->id,
        'title' => 'Product A',
        'description' => 'Product Description',
        'base_price' => 5.99,
        'discounted_price_for_member' => 4.99,
    ]);

    $response = $this
        ->actingAs($user)
        ->post('/user/cart', [
            'product_id' => $product->id,
            'product_title' => $product->title,
            'product_description' => $product->description,
            'quantity' => 1,
            'unit_price' => 5.99,
        ]);

    // response is return redirect back
    $response->assertStatus(302);

    // now check if item is in the cart
    $cartItems = CartItem::where('user_id', $user->id)->get();

    $this->assertCount(1, $cartItems->toArray());

});
