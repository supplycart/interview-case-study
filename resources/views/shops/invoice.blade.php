@extends('layouts.main')

@section('title', 'Invoice')

@section('content')
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-3">
<div class="w-full">
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Invoice Information
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
        This invoice is issued as proof of purchase
      </p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Invoice No. / Date
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $order->invoice }} / {{ $order->created_at }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Total 
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            $ {{ number_format($order->subtotal) }}
          </dd>
        </div>
      </dl>
    </div>
    <div class="px-4 py-5 sm:px-6">
        <p class="text-lg leading-6 font-medium text-gray-900">
          Personal Information
        </p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Full Name
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $order->customer_name }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Phone Number
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $order->customer_phone }}
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Address
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $order->customer_address }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Details
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
              <li class="bg-gray-50 pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center"> 
                  <span class="ml-2 flex-1 w-0 truncate">
                    Product Name
                  </span>
                </div>
                <div class="mr-10 flex-shrink-0">
                    Qty
                </div>
                <div class="ml-4 flex-shrink-0">
                    price
                </div>
              </li>
              @foreach ($order_detail as $order_detail)
              <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center"> 
                  <span class="ml-2 flex-1 w-0 truncate">
                    {{ $order_detail['name'] }}
                  </span>
                </div>
                <div class="mr-10 flex-shrink-0">
                    {{ $order_detail['qty'] }}
                </div>
                <div class="ml-4 flex-shrink-0 text-left">
                    $ {{ $order_detail['price'] }}
                </div>
              </li>
              @endforeach
            </ul>
          </dd>
        </div>
      </dl>
    </div>
  </div>
</div>
</div>
@endsection