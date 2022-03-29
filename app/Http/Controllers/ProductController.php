<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\PaginatedProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['cats'])) {
            return response((new ProductCollection(Product::whereIn("cat_id", $_GET['cats'])->paginate(15)))->response()->getData(true), 200);
        }
        return response((new ProductCollection(Product::paginate(15)))->response()->getData(true), 200);
    }
}
