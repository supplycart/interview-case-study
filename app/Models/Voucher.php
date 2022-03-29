<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Voucher extends Model
{
    use HasFactory;

    protected $table = "vouchers";

    protected $fillable = [
        "name",
        "amount",
        "code"
    ];

    public static function create($attributes) {
        $voucher = new Voucher($attributes);
        if (!isset($attributes["code"])) {
            $voucher->code = Str::random();
        }
        $voucher->save();
        return $voucher;
    }
}
