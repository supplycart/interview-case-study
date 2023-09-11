<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'address' => $this->getUserAddress(),
                'orders' => $this->getUserOrders(),
            ],
            
            'categories' => Category::all(),
            'random_products' => Product::inRandomOrder()->limit(8)->get(),
            'random_men' => $this->getRandomProductsByCategory(4),
            'random_furniture' => $this->getRandomProductsByCategory(1),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }

    private function getUserAddress()
    {
        if (auth()->check()) {
            // If the user is authenticated, fetch their address
            $user = auth()->user();
            $address = Address::where('user_id', $user->id)->first();

            return $address;
        }

        // If the user is not authenticated, return null
        return null;
    }

    private function getUserOrders()
    {
        if (auth()->check()) {
            // If the user is authenticated, fetch their address
            $user = auth()->user();
            $orders = Order::where('user_id', $user->id)->get();

            return $orders;
        }

        // If the user is not authenticated, return null
        return null;
    }

    private function getRandomProductsByCategory($categoryId, $limit = 3)
    {
        return Product::inRandomOrder()
            ->where('category', $categoryId)
            ->limit($limit)
            ->get();
    }
}
