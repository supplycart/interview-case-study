<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class Controller
{
    protected function respond(string $message, int $status = 200, JsonResource|array $data = null)
    {
        $body['message'] = $message;

        if ($data) {
            $body['data'] = $data;
        }

        return response()->json($body, $status);
    }
}
