<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    // Check stock with selected options
    public function checkStock($options)
    {
        $stock = $this->stocks()->whereHas('options', function ($query) use ($options) {
            $query->whereIn('id', $options);
        })->first();

        return $stock;
    }

}
