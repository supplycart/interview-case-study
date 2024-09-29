<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\Brand;
use App\Http\Resources\GoodResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BrandResource;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    public function goods()
    {
        $goods = Good::with('properties');

        return inertia('Index/Goods', [
            'brands' => BrandResource::collection(Brand::whereIn('id', $goods->pluck('brand_id')->all())->get()),
            'prices' => [
                'min' => intval($goods->get()->min('price')),
                'max' => intval($goods->get()->max('price')),
            ],
            'properties' => Good::getFilterableProperties($goods->get())->toArray(),
            'goods' => GoodResource::collection($goods->filtered()->sorted()->paginate(10)->withQueryString()),
        ]);
    }

    public function index(Good $good)
    {
        return inertia('Good/Index', [
            'title' => $good->title,
            'good' => new GoodResource($good),
        ]);
    }

    public function properties(Good $good)
    {
        $good->load('properties');

        return inertia('Good/Properties', [
            'title' => $good->title,
            'good' => new GoodResource($good),
        ]);
    }
}
