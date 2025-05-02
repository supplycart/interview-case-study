<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\Contracts\CartRepositoryInterface;
use Database\Seeders\BrandSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;

class CartRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected CartRepositoryInterface $repo;

    protected function setUp(): void
    {
        parent::setUp();

        // seed brand/category/product before cart logic
        $this->seed([BrandSeeder::class, CategorySeeder::class, ProductSeeder::class]);

        $this->repo = app(CartRepositoryInterface::class);
    }

    public function test_it_adds_product_to_cart()
    {
        $user = User::factory()->create();
        $product = Product::first();

        $cart = $this->repo->addOrUpdate($user->id, $product->id, 2);

        $this->assertEquals($product->id, $cart->product_id);
        $this->assertEquals(2, $cart->qty);
    }

    public function test_it_returns_user_cart()
    {
        $user = User::factory()->create();
        $product = Product::first();

        $this->repo->addOrUpdate($user->id, $product->id, 1);

        $cart = $this->repo->getUserCart($user->id);

        $this->assertCount(1, $cart);
        $this->assertEquals($product->id, $cart[0]['product_id']);
    }

    public function test_it_deletes_cart_item()
    {
        $user = User::factory()->create();
        $product = Product::first();

        $this->repo->addOrUpdate($user->id, $product->id, 1);
        $this->repo->deleteFromCart($user->id, $product->id);

        $cart = $this->repo->getUserCart($user->id);

        $this->assertCount(0, $cart);
    }
}
