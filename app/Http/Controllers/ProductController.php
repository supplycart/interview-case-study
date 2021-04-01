<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Events\ProductAddedToCart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Faker\Generator;
use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Products/Index');
    }

    public function cart()
    {
        return Inertia::render('Cart');
    }
}
