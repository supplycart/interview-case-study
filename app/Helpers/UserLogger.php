<?php
namespace App\Helpers;


use App\Models\UserLog;
use App\Models\User;

use App\Enums\UserLogType;

class UserLogger {
    public static function login(int $userId) {
        UserLog::insert([
            'user_id' => $userId,
            'type' => UserLogType::LOGIN,
            'created_at' => now()
        ]);
    }
    
    public static function logout(int $userId) {
        UserLog::insert([
            'user_id' => $userId,
            'type' => UserLogType::LOGOUT,
            'created_at' => now()
        ]);
    }

    public static function addToCart(int $userId, Array $metadata) {
        UserLog::insert([
            'user_id' => $userId,
            'type' => UserLogType::ADD_TO_CART,
            'metadata' => json_encode($metadata),
            'created_at' => now()
        ]);
    }
    
    public static function removeFromCart(int $userId, Array $metadata) {
        UserLog::insert([
            'user_id' => $userId,
            'type' => UserLogType::REMOVE_FROM_CART,
            'metadata' => json_encode($metadata),
            'created_at' => now()
        ]);
    }
    
    public static function updateCartQuantity(int $userId, Array $metadata) {
        UserLog::insert([
            'user_id' => $userId,
            'type' => UserLogType::UPDATE_CART_QUANTITY,
            'metadata' => json_encode($metadata),
            'created_at' => now()
        ]);
    }

    public static function checkout(int $userId, Array $metadata) {
        UserLog::insert([
            'user_id' => $userId,
            'type' => UserLogType::CHECKOUT,
            'metadata' => json_encode($metadata),
            'created_at' => now()
        ]);
    }
}
