<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);

        return Inertia::render('ProductDetails', [
            'product' => $product,
        ]);
    }

    public function cart()
    {
        // For now, we'll use mock data. In a real application, you'd fetch this from the database or session.
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 19.99,
                'quantity' => 2,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'price' => 29.99,
                'quantity' => 1,
            ],
        ];

        return Inertia::render('Cart', [
            'cartItems' => $cartItems,
        ]);
    }
}
