<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $statusCode = 200;

    public function formatResponse($response, $headers = [])
    {
        $status = $response['status'];
        $json_status = 200 == $status ? 'data' : 'error';

        $response = [
            $json_status => $response
        ];

        return response()->json($response, $status, $headers);
    }

    public function validationErrorResponse($errors)
    {
        $message = [
            'status' => 422,
            'errors' => [$errors],
        ];
        return response()->json($message);
    }
}
