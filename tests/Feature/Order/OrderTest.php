<?php

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('user able to add to place order', function () {
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

    $response = $this
        ->actingAs($user)
        ->post('/user/order', [
            'user_id' => $user->id,
            'cart_item_ids' => $cartItems->pluck('id')->toArray(),
        ]);


    // check got order
    $orders = Order::where('user_id', $user->id)->get();
    $this->assertCount(1, $orders->toArray());

    // check got order items
    $order = $orders->first();
    $orderItems = OrderItem::where('order_id', $order->id)->get();

    $this->assertCount(1, $orderItems->toArray());

    // check total sum is matching
    $this->assertEquals($order->subtotal, $orderItems->sum('subtotal'));
});
