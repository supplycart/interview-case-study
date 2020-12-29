@extends('layouts.app')
@section('content')
@if (session('cart_add_success'))
<!--Header Alert-->
<div class="alert-banner w-full fixed top-0">
    <input type="checkbox" class="hidden" id="banneralert">
    <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" title="close" for="banneralert">
    {{ session('cart_add_success') }}
    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
    </svg>
    </label>
</div>
@endif
@if (session('cart_remove_success'))
<!--Header Alert-->
<div class="alert-banner w-full fixed top-0">
    <input type="checkbox" class="hidden" id="banneralert">
    <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" title="close" for="banneralert">
    {{ session('cart_remove_success') }}
    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
    </svg>
    </label>
</div>
@if (session('cart_update_success'))
<!--Header Alert-->
<div class="alert-banner w-full fixed top-0">
    <input type="checkbox" class="hidden" id="banneralert">
    <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" title="close" for="banneralert">
    {{ session('cart_update_success') }}
    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
    </svg>
    </label>
</div>
@endif
@endif
<div class="flex justify-center my-6">
  <div class="flex flex-col w-full p-8 text-gray-800 bg-white pin-r pin-y md:w-4/5 lg:w-4/5">
    <div class="flex-1">
      <table class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
          <tr class="h-12 uppercase">
            <th class="hidden md:table-cell"></th>
            <th class="text-center">Product</th>
            <th class="lg:text-right text-left pl-5 lg:pl-0">
              <span class="lg:hidden" title="Quantity">Qtd</span>
              <span class="hidden lg:inline">Quantity</span>
            </th>
            <th class="hidden text-right md:table-cell">Unit price</th>
            <th class="text-right">Total price</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cart_products as $product)
          <tr>
            <td class="hidden pb-4 md:table-cell">
              <img src="{{ $product->picture }}" class="w-20 rounded" alt="Thumbnail">
            </td>
            <td class="text-center">
              <a href={{ route('product-detail', ['product' => $product->id])}}>
                <p class="mb-2 md:ml-4">{{ $product->name }}</p>
                <form action="{{ route('remove-product-from-cart', ['product' => $product->id]) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="text-red-500 md:ml-4">
                    <small>(Remove item)</small>
                  </button>
                </form>
              </a>
            </td>
            <td class="md:justify-end md:flex mt-2 pb-2">
              <form action={{ route('update-cart-quantity', [
                  'product' => $product->id
                ])}} method="POST">
                @method('PUT')
                @csrf
              <select name="product_quantity" class="rounded-xl border border-hidden pl-4 pr-8 h-14">
                  @for ($i = 1; $i < $product->quantity + 1; $i++)
                  @if ($i == $product->pivot->product_quantity)
                  <option selected="{{ $i }}" value="{{ $i }}" > {{ $i }} </option>
                  @else
                  <option value="{{ $i }}" onClick="this.form.submit({{ $i }})"> {{ $i }} </option>
                  @endif
                  @endfor
              </select>
              <form>
            </td>
            <td class="hidden text-right md:table-cell">
              <span class="text-sm lg:text-base font-medium">
                ${{ $product->price }}
              </span>
            </td>
            <td class="text-right">
              <span class="text-sm lg:text-base font-medium">
                ${{ $product->price * $product->pivot->product_quantity }}
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="my-4 mt-6">
        <div class="lg:px-2 lg:w">
          <div class="p-4">
            @if (count($cart_products) > 0)
            <form action={{ route('store-orders') }} method="POST">
              @csrf
              <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                <span class="ml-2 mt-5px">Place Order</span>
              </button>
            </form>
            @else
            <p class="flex justify-center w-full px-10 py-3 mt-6 font-medium uppercase"> There are currently no products in your cart </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection