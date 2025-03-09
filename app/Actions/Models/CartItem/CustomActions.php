<?php

namespace App\Actions\Models\CartItem;

use App\Models\CartItem;

class CustomActions
{
    public static function calculateItemSubtotal($request)
    {
        $quantity = floatval($request['quantity']);
        $unitPrice = floatval($request['unit_price']);

        $subtotal = $quantity * $unitPrice;

        return $subtotal;
    }

    public static function bulkDelete($ids)
    {
        CartItem::whereIn('id', $ids)->delete();
    }
}
