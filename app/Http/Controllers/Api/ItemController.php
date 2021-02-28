<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('item');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'image' => ['required', 'image'],
        ]);

        request('image')->store('uploads');

        $imagePath = request('image')->hashName();
        $image = Image::make(storage_path("/app/uploads/$imagePath"))->fit(600, 400);
        $image->save();

        Item::create([
            'name' => $data['name'],
            'desc' => $data['desc'],
            'price' => $data['price'],
            'image' => $imagePath,
        ]);

        return redirect('/');
    }
}
