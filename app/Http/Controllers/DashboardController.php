<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() 
    {
        if (Auth::check()) {

            $products = Product::all();

            if ($products->count() === 0) {   
                $products = [];
            }

            return view('dashboard', ['data' => $products]);
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');

    }
}
