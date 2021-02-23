<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
{
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

        $imagePath = request("image")->store("uploads", "public");

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 400);
        $image->save();

        Item::create([
            'name' => $data["name"],
            'desc' => $data["desc"],
            'price' => $data["price"],
            'image' => $imagePath,
        ]);

        return redirect("/");
    }
}
