<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use DB;
use Validator;

class BrandController extends Controller
{

    public function index()
    {
        return response()->json(
            [
                "status"  => true,
                "data"    => Brand::all(),
                "message" => "success",
            ]
        );
    }

}
