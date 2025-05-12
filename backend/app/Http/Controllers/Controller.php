<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Controller
{
    protected function respond(string $message, int $status = 200, JsonResource|array $data = null): JsonResponse
    {
        $response['message'] = $message;

        if ($data) {
            if ($data->resource instanceof LengthAwarePaginator) {
                $data = $data->response()->getData(true);
                unset($data['meta']['links']);
                $response['data'] = $data['data'];
                $response['meta'] = $data['meta'];
                $response['links'] = $data['links'];
            } else {
                $response['data'] = $data;
            }
        }

        return response()->json($response, $status);
    }
}
