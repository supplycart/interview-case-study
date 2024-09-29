<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodUser extends Model
{
    use HasFactory;

    protected $fillable = ['good_id', 'user_id'];

    protected $table = 'good_user';
}
