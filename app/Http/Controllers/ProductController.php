<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return ProductResource::collection(Product::orderBy('created_at', 'DESC')->paginate(10));
    }
}
