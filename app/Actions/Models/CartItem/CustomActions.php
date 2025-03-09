<?php

namespace App\Actions\Models\CartItem;

class CustomActions
{
    public static function calculateItemSubtotal($request)
    {
        $quantity = floatval($request['quantity']);
        $unitPrice = floatval($request['unit_price']);

        $subtotal = $quantity * $unitPrice;

        return $subtotal;
    }

    /**
     * $itemsSubtotal : [ 1.99, 4.99, 6.99 ] ;
     * $subtotal = 13.97
     */
    public static function calculateSubtotal($itemsSubtotal)
    {
        $subtotal = array_sum($itemsSubtotal);

        return $subtotal;
    }

    /**
     * $subtotal : 13.97
     * $roundingAdjustment : 14.00 - 13.97 = 0.03
     */
    public static function calculateRoundingAdjustment($subtotal)
    {
        $roundedSubtotal = round($subtotal);

        $roundingAdjustment = $roundedSubtotal - $subtotal;

        return $roundingAdjustment;
    }

    /**
     * $subtotal : 13.97
     * $roundingAdjustment : 0.03
     * $discountAmount : 4.00
     *
     * $grandTotal = 13.97 + 0.03 - 4.00 = 10.00
     */
    public static function calculateGrandTotal($subtotal, $roundingAdjustment, $discountAmount)
    {
        $grandTotal = $subtotal + $roundingAdjustment - $discountAmount;

        return $grandTotal;
    }
}
