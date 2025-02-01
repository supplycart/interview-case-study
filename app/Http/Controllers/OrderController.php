<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller {
    /**
     * Display the user's order.
     */
    public function view(Request $request): Response
    {
        return Inertia::render('Order/View');
    }
}
