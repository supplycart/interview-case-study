<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
        
    }


    public function index()
    {
        $products = Product::get();
        $categories = Category::get();
        $subcategories = Subcategory::get();
        return view('admin.home')->with('products',$products)->with('categories',$categories)->with('subcategories',$subcategories);
    }
}
