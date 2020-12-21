@extends('layouts.main')

@section('title', 'Shopping Cart List')

@section('content')
<!-- component -->
<div class="w-full container mx-auto flex flex-wrap items-center justify-between px-6 mt-0 py-3">
  <div class="w-full flex justify-center my-6">    
    <div class="flex-1">
      <form action="{{ route('updateCart') }}" method="post">
        @csrf
        <table class="w-full text-sm lg:text-base" cellspacing="0">
          <thead>
            <tr class="h-12 uppercase">
              <th class="hidden md:table-cell"></th>
              <th class="text-left">Product</th>
              <th class="lg:text-right text-left pl-5 lg:pl-0">
                <span class="lg:hidden" title="Quantity">Qtd</span>
                <span class="hidden lg:inline">Quantity</span>
              </th>
              <th class="hidden text-right md:table-cell">Unit price</th>
              <th class="text-right">Total price</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($carts as $row)
            <tr>
              <td class="hidden pb-4 md:table-cell">
                @if (empty($row['product_image']))
                  <img class="h-10 w-10" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                @else
                  <img class="h-10 w-10" src="{{ asset('storage/products/' .  $row['product_image'] ) }}">
                @endif
              </td>
              <td>
                <p class="mb-2 md:ml-4">{{ $row['product_name'] }}</p>
                <small class="text-gray-700 md:ml-4">{{ $row['product_desc'] }}</small>
              </td>
              <td class="justify-center md:justify-end md:flex mt-6">
                <div class="w-20 h-10">
                  <div class="relative flex flex-row w-full h-8">
                    <button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>
                    <input type="text" name="qty[]" id="sst{{ $row['product_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none">
                    <input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}" class="form-control">
                
                    <button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                  </div>
                </div>
              </td>
              <td class="hidden text-right md:table-cell">
                <span class="text-sm lg:text-base font-medium">
                  $ {{ number_format($row['product_price']) }}
                </span>
              </td>
              <td class="text-right">
                <span class="text-sm lg:text-base font-medium">
                  $ {{ number_format($row['product_price'] * $row['qty']) }}
                </span>
              </td>
            </tr> 
            @empty
            <tr>
              <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Cart is empty 
              </td>
            </tr>
            @endforelse
            <tr>
              <td class="hidden pb-4 md:table-cell"></td>
              <td></td>
              <td class="justify-center md:justify-end md:flex mt-6"></td>
              <td class="hidden text-right md:table-cell"></td>
              <td class="text-right">
                <button class="w-full m-2 font-semibold py-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                  Update Cart
                </button>              
              </td>
            </tr> 
          </tbody>
        </table>
      </form>
      <hr class="pb-6 mt-6">
      <div class="my-4 mt-6 -mx-2 lg:flex">
        <div class="lg:px-2 lg:w-1/2">
          <div class="p-4 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase">
              <a class="center px-4 py-2" href="{{ route('product') }}">Continue Shopping</a>
            </h1>
          </div>
        </div>
        <div class="lg:px-2 lg:w-1/2">
          <div class="p-4 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase">Order Details</h1>
          </div>
          <div class="p-4">
            <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                Subtotal
              </div>
              <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                $ {{ number_format($subtotal) }}
              </div>
            </div>
            <form class="row contact_form" action="{{ route('checkProcess') }}" method="post" novalidate="novalidate">
              @csrf                   
              <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                <span class="ml-2 mt-5px">Procceed to checkout</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection