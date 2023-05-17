<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class GeneralService
{
    public function response($status_code, $message, $data = [])
    {
        $payload = [
            'status' => $status_code,
            'message' => $message
        ];

        if ($data) {
            $payload['data'] = $data;
        }

        return $payload;
    }

    public function logError($message, $payload = [])
    {
        $user = auth()->user();
        $route = Route::getCurrentRoute() ? Route::getCurrentRoute()->getAction() : '';

        if ($user) {
            $payload['user'] = [
                'name' => $user->name,
                'email' => $user->email
            ];
        }

        if (isset($route['controller'])) {
            $payload['route'] = $route['controller'];
        }

        Log::error($message, $payload);
    }

    public function logInfo($message, $payload = [])
    {
        $user = auth()->user();
        $route = Route::getCurrentRoute() ? Route::getCurrentRoute()->getAction() : '';

        if ($user) {
            $payload['user'] = [
                'name' => $user->name,
                'email' => $user->email
            ];
        }

        if (isset($route['controller'])) {
            $payload['route'] = $route['controller'];
        }

        Log::info($message, $payload);
    }
    
    public function formatGeneralResponse($message, $status, $http_code, $attribute = [])
    {
        $response = [
            'status' => $status,
            'http_code' => $http_code,
            'message' => $message
        ];

        if (!empty($attribute)) {
            $response['attribute'] = $attribute;
        }

        return $response;
    }

    public function formatResourceResponse($data, $status, $http_code)
    {
        $response = [
            'status' => $status,
            'http_code' => $http_code,
            'data' => $data
        ];

        return $response;
    }

    public function formatErrorResponse($message = null, $status_code = null, $http_status_code = null, $attributes = [])
    {
        $status_code = $status_code ?? 'Internal Server Error';
        $http_status_code = $http_status_code ?? 'Internal Server Error';

        $data = [
            'status' => $status_code,
            'http_code' => $http_status_code,
            'errors' => $message
        ];

        if (!empty($attributes)) {
            $data['attributes'] = $attributes;
        }

        return $data;
    }
}
