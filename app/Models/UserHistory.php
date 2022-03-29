<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "type",
        "related_id",
    ];

    public static function create($attributes) {
        $history = new UserHistory($attributes);
        $history->save();
        return $history;
    }

    public function connectedUser() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function connectedProduct() {
        return $this->hasOne(Product::class, "id", "related_id");
    }
}
