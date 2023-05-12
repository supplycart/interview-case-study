<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_product_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
    }

    public function test_product_can_be_added(): void
    {
        $user = User::factory()->create();
        Storage::fake('public');

        $response = $this
            ->actingAs($user)
            ->post('/products', [
                'name' => 'Kurung Moden',
                'price' => 15.25,
                'image' => UploadedFile::fake()->image('random.jpg'),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/dashboard')
            ->assertSessionHas('success', 'Product added.');
    }

    public function test_product_validation_error_when_added(): void
    {
        $user = User::factory()->create();
        Storage::fake('public');

        $response = $this
            ->actingAs($user)
            ->post('/products', [
                'name' => 'Kurung Moden',
                'price' => 15.25,
                'images' => UploadedFile::fake()->image('random.jpg'),
            ]);

        $response->assertSessionHasErrors();
    }
    public function test_product_error_when_added(): void
    {
        $user = User::factory()->create();
        Storage::fake('public');

        DB::shouldReceive('transaction')
            ->once()
            ->withAnyArgs()
            ->andThrow(new \Exception('Something went wrong during transaction.'));

        $response = $this
            ->actingAs($user)
            ->post('/products', [
                'name' => 'Kurung Moden',
                'price' => 15.25,
                'image' => UploadedFile::fake()->image('random.jpg'),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/dashboard')
            ->assertSessionHas('error', 'Something went wrong.');
    }
}
