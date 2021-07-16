@extends('app')
@section('title', 'Cart')
@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    #summary {
      background-color: #f6f6f6;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto mt-10">
    <div class="flex shadow-md my-10">
      <div class="w-full bg-white px-10 py-10">
        <div class="flex justify-between border-b pb-8">
          <h1 class="font-semibold text-2xl">Shopping Cart</h1>
        </div>
        @foreach($orders as $order => $product)
        <br>
        <?php $time = $product['created_at'];
              $number = $product['id'];
              $total = 0; ?>
        <h2 class="font-semibold text-2xl">Order #{{$number}}</h2>
        <h5 class="font-semibold text-2xl">Date: {{$time}}</h5>
          <div class="flex mt-10 mb-5">
            <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
          </div>
          <?php $listOfOrder = json_decode($product['products'], true) ?>
          @foreach($listOfOrder as $single_product)
            <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                <div class="flex w-2/5"> <!-- product -->
                    <div class="w-20">
                    <img class="h-24" src="{{ $single_product['photo'] }}" alt="">
                    </div>
                    <div class="flex flex-col justify-between ml-4 flex-grow">
                        <span class="font-bold text-sm">{{ $single_product['name'] }}</span>
                    </div>
                </div>
                <div class="flex justify-center w-1/5">
                    <!-- <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                    </svg> -->
                    <span class="text-center w-1/5 font-semibold text-sm">{{ $single_product['quantity'] }}</span>
                    <!-- <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                    <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                    </svg> -->
                </div>
                <span class="text-center w-1/5 font-semibold text-sm">${{ $single_product['price'] }}</span>
                <span class="text-center w-1/5 font-semibold text-sm">${{ $single_product['price'] * $single_product['quantity'] }}</span>
                <?php $total += $single_product['price'] * $single_product['quantity'] ?>
              </div>
          @endforeach
          <div class="flex font-semibold text-sm uppercase">
            <span>Total cost: ${{ $total }}</span>
          </div>
        @endforeach
      </div>


    </div>
  </div>
</body>