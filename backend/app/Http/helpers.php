<?php

use App\Models\Cart;
use App\Models\Country;

if (!function_exists('getUserCountry')) {
    /**
     * Get current request user country.
     *
     * @return Country|null
     */
    function getUserCountry(): Country|null
    {
        return request()?->user()?->load('country')->country;
    }

    /**
     * Get current request user cart.
     *
     * @return Cart|null
     */
    function getUserCart(): Cart|null
    {
        return request()?->user()?->load([
            'cart', 'cart.items',
            'cart.items.product', 'cart.items.product.price',
            'cart.items.product.brand', 'cart.items.product.category',
        ])->cart;
    }
}
