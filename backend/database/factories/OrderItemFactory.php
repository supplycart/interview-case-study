<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $product = Product::with(['brand', 'category'])->first();
        $price = Price::factory()->create([
            'product_id' => $product->id,
            'country_id' => Country::where('code', 'MY')->first()->id,
        ]);
        $quantity = $this->faker->randomNumber();

        return [
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'product_name' => $product->name,
            'brand_name' => $product->brand->name,
            'category_name' => $product->category->name,
            'price_amount' => $price->amount,
            'quantity' => $quantity,
            'total' => $price->amount * $quantity,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
