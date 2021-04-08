<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodects extends Model
{
    use HasFactory;

    //this attribute for fillable cloumn in table 
    protected $fillable = ['name','brand','category','price','photo'

    ];

    //this attribute for hidden cloumn in table 
    protected $hidden =['created_at','updated_at'
          
    ];

    public function orders()
    {
        return $this->belongsToMany(Orders::class);
    }
}
