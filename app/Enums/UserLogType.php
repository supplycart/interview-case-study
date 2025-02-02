<?php
namespace App\Enums;

enum UserLogType: string {
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case ADD_TO_CART = 'add_to_cart';
    case REMOVE_FROM_CART = 'remove_from_cart';
    case UPDATE_CART_QUANTITY = 'update_cart_quantity';
    case CHECKOUT = 'checkout';
}
