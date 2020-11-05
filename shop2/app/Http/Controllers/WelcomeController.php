<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class WelcomeController extends Controller
{
    public function index(){
        $products = Product::get();
        $categories = Category::get();
        $subcategories = Subcategory::get();

        return view('welcome')->with('products', $products)->with('categories', $categories)->with('subcategories', $subcategories);
    }
}
