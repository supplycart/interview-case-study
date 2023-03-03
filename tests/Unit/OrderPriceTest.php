<?php
use App\Services\CartService;

test('assert total amount without discount equals', function() {
    $data = [
        'input' => [
            'price' => 500,
            'quantity' => 5
        ],
        'output' => 2500
    ];

    $input = $data['input'];

    $total_amount = (new CartService())->getTotalAmount($input['price'], $input['quantity']);
    $this->assertEquals($data['output'], $total_amount);
});

test('assert total amount with discount equals', function() {
    $data = [
        'input' => [
            'price' => 500,
            'quantity' => 5,
            'discount' => 10
        ],
        'output' => 2250
    ];

    $input = $data['input'];

    $total_amount = (new CartService())->getTotalAmount($input['price'], $input['quantity'], $input['discount']);
    $this->assertEquals($data['output'], $total_amount);
});

test('assert total discount without discount equals', function() {
    $data = [
        'input' => [
            'price' => 500,
            'discounted_price' => 500,
            'quantity' => 5
        ],
        'output' => 0
    ];

    $input = $data['input'];

    $total_discount = (new CartService())->getTotalDiscount($input['price'], $input['discounted_price'], $input['quantity']);
    $this->assertEquals($data['output'], $total_discount);
});

test('assert total discount with discount equals', function() {
    $data = [
        'input' => [
            'price' => 500,
            'discounted_price' => 450,
            'quantity' => 5
        ],
        'output' => 250
    ];

    $input = $data['input'];

    $total_discount = (new CartService())->getTotalDiscount($input['price'], $input['discounted_price'], $input['quantity']);
    $this->assertEquals($data['output'], $total_discount);
});