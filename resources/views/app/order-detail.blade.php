@extends('layouts.app')
@section('content')
@if (session('order_add_success'))
<!--Header Alert-->
<div class="alert-banner w-full fixed top-0">
    <input type="checkbox" class="hidden" id="banneralert">
    <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" title="close" for="banneralert">
    {{ session('order_add_success') }}
    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
    </svg>
    </label>
</div>
@endif
<div class="flex justify-center my-6">
  <div class="flex flex-col w-full p-8 text-gray-800 bg-white pin-r pin-y md:w-4/5 lg:w-4/5">
    <div class="flex-1">
      <table class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
          <tr class="h-12 uppercase">
            <th class="text-center md:table-cell"></th>
            <th class="text-center">Product</th>
            <th class="text-center  pl-5 lg:pl-0">
              <span class="lg:hidden" title="Quantity">Qtd</span>
              <span class="text-center hidden lg:inline">Quantity</span>
            </th>
            <th class="text-center hidden md:table-cell">Unit price</th>
            <th class="text-center">Total price</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order_products as $product)
          <tr>
            <td class="pb-4 md:table-cell">
              <img src="{{ $product->picture }}" class="w-20 rounded" alt="Thumbnail">
            </td>
            <td class="text-center">
              <a href={{ route('product-detail', ['product' => $product->id])}}>
              <p class="mb-2 md:ml-4">{{ $product->name }}</p>
              </a>
            </td>
            <td class="hidden text-center md:table-cell">
                <span class="text-sm lg:text-base font-medium">
                    {{ $product->pivot->order_quantity }}
                </span>
            </td>
            <td class="hidden text-center md:table-cell">
              <span class="text-sm lg:text-base font-medium">
                ${{ round($product->pivot->order_price, 2) }}
              </span>
            </td>
            <td class="text-center">
              <span class="text-sm lg:text-base font-medium">
                ${{ round($product->pivot->total_order_price, 2) }}
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <hr class="pb-6 mb-6">
      <div class="flex-1">
        <div class="p-4 bg-gray-100 rounded-full">
          <h1 class="ml-2 font-bold uppercase">Order Details</h1>
        </div>
        <div class="p-4">
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                Order Total
              </div>
              <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                ${{ $order_total }}
              </div>
            </div>
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                Status
              </div>
              <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-green-500">
                Placed
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection