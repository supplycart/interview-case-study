<?php

namespace App\Http\Controllers\Api;

use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderApiController extends ApiController
{
    protected $order;

    function __construct(OrderService $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $results = $this->order->index();

        return $this->formatResponse($results);
    }

    public function store(Request $request)
    {
        $results = $this->order->store($request->all());

        return $this->formatResponse($results);
    }
}
