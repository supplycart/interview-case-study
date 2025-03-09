<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    public static function index()
    {
        dd('index');
    }

    public static function create($id)
    {
        dd('create');
    }

    public static function store($request)
    {
        dd('store');
    }

    public static function show($id)
    {
        dd('show');
    }

    public static function edit($id)
    {
        dd('edit');
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
