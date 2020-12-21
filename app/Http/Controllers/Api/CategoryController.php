<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;
use Validator;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(
            [
                "status"  => true,
                "data"    => Category::all(),
                "message" => "success",
            ]
        );
    }

}
