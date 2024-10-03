<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController
{
    public function getCategory(){
        try{
            $category_list = Category::where('status', 1)->get();

            return response()->json(['data' => $category_list], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 500);
        }
    }
}
