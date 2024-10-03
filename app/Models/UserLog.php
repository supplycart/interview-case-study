<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = "user_log";
    protected $fillable = ['user_id', 'action'];

    public function log($user_id, $action) {
        $this->action = $action;
        $this->user_id = $user_id;
        return $this->save();
    }
}
