<?php

use App\Models\Cart;
use App\Models\Country;
use App\Models\RunningNumber;

if (!function_exists('getUserCountry')) {
    /**
     * Get current request user country.
     *
     * @return Country|null
     */
    function getUserCountry(): Country|null
    {
        return auth()?->user()?->load('country')->country;
    }
}

if (!function_exists('getUserCart')) {
    /**
     * Get current request user cart.
     *
     * @return Cart|null
     */
    function getUserCart(): Cart|null
    {
        return auth()?->user()?->load([
            'cart', 'cart.items',
            'cart.items.product', 'cart.items.product.price',
            'cart.items.product.brand', 'cart.items.product.category',
        ])->cart;
    }
}

if (!function_exists('getOrderRunningNumber')) {
    /**
     * Get order running number.
     *
     * @param bool $increase
     * @return string
     */
    function getOrderRunningNumber(bool $increase = true): string
    {
        $orderRunningNumber = RunningNumber::query()
            ->where('name', 'order')
            ->first();

        if ($increase) {
            $orderRunningNumber->increment('number');
        }

        return str_pad($orderRunningNumber->number, 8, '0', STR_PAD_LEFT);
    }
}
