<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'quantity', 'price', 'status', 'image'
    ];

    protected $casts = [
        'quantity' =>  'integer',
        'price'  =>  'float',
        'status'      =>  'boolean'
    ];

    /*******************
     * MUTATOR FUNCTIONS
     ******************
     */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /*******************
     * ENTTITY FUNCTIONS
     ******************
     */

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getImage()
    {
        return $this->image;
    }


}
