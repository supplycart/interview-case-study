<?php

namespace App\Actions\Models\Category;

use App\Models\Category;

class StandardActions
{
    public static function index($request)
    {
        if (!isset($request))
        {
            return Category::paginate();
        }

        $categorys = Category::query();

        if (isset($request['filters']) && !empty($request['filters']))
        {
            $filters = $request['filters'];

            $categorys->query()
                ->when(isset($filters['name']), function($subquery) use ($filters) { $subquery->where('name', $filters['name']); })
                ->when(isset($filters['position']), function($subquery) use ($filters) { $subquery->where('position', $filters['position']); })
                ;
        }

        if (isset($request['search']))
        {
            $search = $request['search'];

            $categorys->query()
                ->where('name', 'like', "%{$search}%")
                ;
        }

        return $categorys->paginate();
    }

    public static function show($id)
    {
        $category = Category::findOrFail($id);

        return $category;
    }

    public static function store($request)
    {
        $category = Category::create($request);

        return $category;
    }

    public static function update($id, $request)
    {
        $category = Category::findOrFail($id);
        $category = $category->update($request);

        return $category;
    }

    public static function delete($id)
    {
        $category = Category::findOrFail($id);
        $category = $category->delete();

        return $category;
    }
}
