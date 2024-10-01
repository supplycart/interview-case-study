<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Good;

test('test store add item to cart', function () {
    Category::factory()->create();
    $user = User::factory()->create();
    $good = Good::factory()->create();

    $response = $this->actingAs($user)->post(route('cart.store', $good), [
        'quantity' => 2,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('cart_items', [
        'user_id' => $user->id,
        'good_id' => $good->id,
        'quantity' => 2,
    ]);
});
