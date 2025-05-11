<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class ProductApiTest extends TestCase
{
    use RefreshDatabase; // Reset the database for each test
    use WithFaker;

    // Property to hold the authenticated user
    protected User $user;

    // Setup method to run before each test
    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a test user for each test
        $this->user = User::factory()->create();
        $this->actingAs($this->user); // Authenticate the user
    }

    /** @test */
    public function authenticated_user_can_view_list_of_products()
    {
        // Arrange: Create some products
        $products = Product::factory()->count(5)->create();

        // Act: Make a GET request to the product list endpoint
        $response = $this->getJson('/api/products');

        // Assert: Check the response status and structure
        $response->assertStatus(200);

        // Assert that the response contains products
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'price_in_cents', // Ensure 'price' is present (assuming resource makes this available)
                    'formatted_price',
                    'stock_quantity',
                    'attributes',
                ]
            ],
            'links',
            'meta'
        ]);

        // Assert that the number of products in the response matches the number created
        $this->assertCount(5, $response->json('data'));
    }

    /** @test */
    public function authenticated_user_can_filter_products_by_category()
    {
        // Arrange: Create products with the desired category
        $desiredCategory = Category::factory()->create(['name' => 'Electronics', 'slug' => 'electronics']);

        Product::factory()->count(3)->create(['category_id' => $desiredCategory->id]);

        // Act: Make a GET request with category filter
        $response = $this->getJson('/api/products?category_slug=electronics');

        // Assert: Check the response status and filtered data
        $response->assertStatus(200);

        // Assert that only products from the desired category are returned
        $this->assertCount(3, $response->json('data'));
        foreach ($response->json('data') as $product) {
            $this->assertEquals($desiredCategory->id, $product['category_id']);
        }
    }

    /** @test */
    public function authenticated_user_can_filter_products_by_brand()
    {
        // Arrange: Create products with the desired brand
        $desiredBrand = Brand::factory()->create(['name' => 'Apple', 'slug' => 'apple']);

        Product::factory()->count(4)->create(['brand_id' => $desiredBrand->id]);
        Product::factory()->count(2)->create(); // Products without a specific brand

        // Act: Make a GET request with brand filter
        $response = $this->getJson('/api/products?brand_slug=apple');

        // Assert: Check the response status and filtered data
        $response->assertStatus(200);

        // Assert that only products from the desired brand are returned
        $this->assertCount(4, $response->json('data'));
        foreach ($response->json('data') as $product) {
            $this->assertEquals($desiredBrand->id, $product['brand_id']);
        }
    }
}
