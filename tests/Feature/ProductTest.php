<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Supplycart\Products\Repository;
use Supplycart\Products\Products;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
        /**
     * @test
     */
    public function shouldGetProductProperly()
    {
        $object = (object) ['something'];
        $repository = $this->createMock(Repository::class);
        $repository->method('getAllwithSpecialPrice')->willReturn($object);
        $products = new Products($repository);
        $this->assertEquals($object, $products->get());
    }
}
