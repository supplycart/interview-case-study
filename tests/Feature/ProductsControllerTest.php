<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Tests\TestCase;


class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function guests_cannot_see_products_page_test()
    {
        $response = $this->get('/products');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_user_can_see_products_page_test()
    {
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->get('/products');

        $response->assertOk();
    }
}
