<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->isbn10,
            'name' => $this->faker->colorName . ' ' . $this->faker->lastName,
            'brand' => $this->randomBrands(),
            'category' => $this->randomCategory(),
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'price' => rand(10, 1000) / 10,
            'stock' => rand(1, 100),
            'image_path' => $this->randomImage()
        ];
    }

    public function randomProductName() 
    {

    }

    public function randomBrands()
    {
        $brands = ['Canon', 'Nikon', 'Pentax', 'Tesco', 'Shell', 'Lego', 'Levis', 'Adidas', 'Nestle'];
        return $brands[rand(0, count($brands) - 1)];
    }

    public function randomCategory()
    {
        $category = ['Camera', 'Food', 'Drinks', 'Toys', 'Apparel'];
        return $category[rand(0, count($category) - 1)];
    }

    public function randomImage()
    {
        $images = [
            'https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2019/04/2-2.jpg',
            'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/279906/pexels-photo-279906.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/4113688/pexels-photo-4113688.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260'

        ];
        return $images[rand(0, count($images) - 1)];
    }
}
