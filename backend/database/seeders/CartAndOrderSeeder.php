<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CartAndOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Product $products */
        $products = Product::with(['brand', 'category', 'prices'])->inRandomOrder()->limit(2)->get();
        CartItem::factory(2)
            ->sequence(function (sequence $sequence) use ($products) {
                return [
                    'product_id' => $products[$sequence->index],
                    'quantity' => rand(1,2),
                ];
            })
            ->create([
                'cart_id' => 1,
            ]);

        $country = Country::where('countries.code', 'MY')->first();

        $orders = Order::factory(2)
            ->create([
            'user_id' => 1,
            'number' => getOrderRunningNumber(),
            'currency' => $country->currency,
            'tax_name' => $country->tax_name,
            'tax_rate' => $country->tax_rate,
        ]);

        foreach ($orders as $order) {
            OrderItem::factory(2)
                ->sequence(function (sequence $sequence) use ($products, $country, $order) {
                    /** @var Product $product */
                    $product = $products[$sequence->index];
                    $price = $product->prices->where('country_id', $country->id)->first();
                    $quantity = rand(1,2);
                    $total = $price->amount * $quantity;
                    $order->total += $total;
                    return [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'brand_name' => $product->brand->name,
                        'category_name' => $product->category->name,
                        'price_amount' => $price->amount,
                        'quantity' => $quantity,
                        'total' => $total,
                    ];
                })
                ->create([
                    'order_id' => $order->id,
                ]);

            $order->update([
                'total' => $order->total,
                'tax_amount' => $order->total * ($country->tax_rate / 100),
                'total_payable' => $order->total + ($order->total * ($country->tax_rate / 100)),
            ]);
        }
    }
}
