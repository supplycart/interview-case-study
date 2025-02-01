<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller {
    /**
     * Display the user's cart.
     */
    public function view(Request $request): Response
    {
        return Inertia::render('Cart/View');
    }
}
