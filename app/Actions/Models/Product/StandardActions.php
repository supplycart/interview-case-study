<?php

namespace App\Actions\Models\Product;

class StandardActions
{
    public static function index()
    {
        dd('index');
    }

    public static function show($id)
    {
        dd('show');
    }

    public static function store($request)
    {
        dd('store');
    }

    public static function update($id, $request)
    {
        dd('update');
    }

    public static function delete($id)
    {
        dd('delete');
    }
}
