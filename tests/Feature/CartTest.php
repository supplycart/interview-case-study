<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    /**
     * Negative Case: Get Cart with Cart Items
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_unauthenticated_user_get_cart()
    {
        $response = $this->getJson('/api/cart');
        $response->assertStatus(401); //unauthenticated
    }

    /**
     * Positive Case: Get Cart with Cart Items
     * Expected: Return Products
     * @test
     */
    public function positive_case_authenticated_user_get_cart()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['cart']
        );
        $response = $this->getJson('/api/cart');
        $response->assertStatus(200);
    }

    /**
     * Negative Case: Get Cart with Cart Items
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_unauthenticated_user_add_to_cart()
    {
        $response = $this->getJson('/api/add-to-cart');
        $response->assertStatus(401); //unauthenticated
    }

    /**
     * Negative Case:Add to Cart
     * Expected: Return Status 200
     * @test
     * @return void
     */
    public function positive_case_add_to_cart()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['add-to-cart']
        );
        $data =[
            "id" => 23,
            "name" => "Lonny Carter",
            "type" => 3,
            "price" => "13.00",
            "cart_id" => 1,
        ];

        $response = $this->postJson('/api/add-to-cart',$data);
        $response->assertStatus(200);
    }

    /**
     * Negative Case: Add to cart without data
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_add_to_cart_missing_params()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['add-to-cart']
        );
        $data =[];

        $response = $this->postJson('/api/add-to-cart',$data);
        $response->assertStatus(400);
    }

    /**
     * Negative Case: Add to cart without one of the data(price)
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_add_to_cart_missing_one_params()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['add-to-cart']
        );

        $data =[
            "id" => 23,
            "name" => "Lonny Carter",
            "type" => 3,
            "cart_id" => 1,
        ];

        $response = $this->postJson('/api/add-to-cart',$data);
        $response->assertStatus(400);
    }

    /**
     * Negative Case: Get Cart with Cart Items
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_unauthenticated_user_checkout()
    {
        $response = $this->postJson('/api/checkout');
        $response->assertStatus(401); //unauthenticated
    }

    /**
     * Negative Case: Get Cart with Cart Items
     * Expected: Return unauthorised (401)
     * @test
     * @return void
     */
    public function negative_case_checkout_without_data()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['add-to-cart']
        );

        $response = $this->postJson('/api/checkout');
        $response->assertStatus(400);
    }

    /**
     * Negative Case: Get Cart with Cart Items
     * Expected: Return unauthorised (401)
     * @test
     * @param Faker $faker
     * @return void
     */
    public function positive_case_checkout_with_data()
    {
        Passport::actingAs(
            $user = factory(User::class)->create(),
            ['add-to-cart']
        );

        $data = [
            'id' => 1,
            'items' => [
                0 => [
                    "id" => 5,
                    "cart_id" => 1,
                    "product_id" => 32,
                    "product_name" => "Dr. Darrion Abshire II",
                    "product_type" => 3,
                    "created_at" => "2020-10-14 14:30:00",
                    "updated_at" => "2020-10-14 14:30:00",
                    "product_price" => "38.00",
                ]
            ],
            "user_id" => '1',
            "total_price" => 30.00
        ];

        $response = $this->postJson('/api/checkout',$data);
        $response->assertStatus(200);
    }

}
