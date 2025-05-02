<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Database\Seeders\BrandSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\ProductSeeder;

class OrderRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_place_order_with_seeded_product()
    {
        $this->seed([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);        

        $user = \App\Models\User::factory()->create();
        $product = \App\Models\Product::first(); // get a seeded product

        $repo = app(\App\Repositories\Contracts\OrderRepositoryInterface::class);

        $repo->createOrder($user->id, $user->name, [
            ['product_id' => $product->id, 'quantity' => 2],
        ]);

        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);
    }

    public function test_it_returns_user_orders()
    {
        $this->seed([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    
        $user = User::factory()->create();
        $product = Product::first(); // ✅ Use actual seeded product
    
        $repo = app(OrderRepositoryInterface::class);
    
        $repo->createOrder($user->id, 'Test User', [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);
    
        $orders = $repo->getUserOrders($user->id);
    
        $this->assertIsArray($orders);
        $this->assertCount(1, $orders);
        $this->assertEquals('placed', $orders[0]['status']);
    }
}
