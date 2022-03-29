<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\CartFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_AddToCartAndNoDuplicated()
    {
        $user = User::first();
        Auth::login($user);

        $tmp = (new CartFactory())->definition();
        $response = $this->post("/api/cart", $tmp);

        $response->assertStatus(201);

        $found = false;

        foreach ($user->carts() as $cart) {
            if ($cart->product_id == $tmp["product_id"]) {
                $found = true;
            }
        };

        self::assertTrue($found);
        $response = $this->post("/api/cart", $tmp);
        $response->assertStatus(400); // no duplicated product allowed
    }
}
