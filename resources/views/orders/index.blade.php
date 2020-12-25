@extends('layouts.app')

@section('content')
  <div>
    <div class="flex flex-col p-2 py-6 m-h-screen">
      <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
        View Order History
      </div>
      <div class="bg-white items-center justify-between w-full flex rounded-full shadow-lg p-2 mb-5 sticky" style="top: 5px">
        <div class="flex flex-col gap-4 lg:p-4 p-2 w-full m-2">        
          @foreach($orders as $order) 
          <div class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full hover:bg-gray-100 cursor-pointer border-2 rounded-lg">
              <div class="lg:flex md:flex items-center">
                <div class="h-12 w-12 mb-2 lg:mb-0 border md:mb-0 rounded-full mr-3"></div>
                <div class="flex flex-col">
                  <div class="text-sm leading-3 text-gray-700 font-bold w-full mb-2">Order Id: {{ $order->id }}</div>
                  <div class="text-xs text-gray-600 w-full">Order placed: {{ date('d-m-Y', strtotime($order->created_at)) }}</div>
                  <div class="text-xs text-gray-600 w-full">Fulfilled: {{ $order->is_fulfilled ? 'Yes' : 'No' }}</div>                            
                </div>
              </div>
              <svg class="h-6 w-6 mr-1 invisible md:visible lg:visible xl:visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
              </svg>                  
          </div>   
          @foreach($order->orderDetails as $detail)
              <div class="ml-20 flex">
                <div class="text-xs text-gray-600 mr-4"><span class="font-semibold">Product Name:</span> {{ $detail->productName }}</div>
                <div class="text-xs text-gray-600"><span class="font-semibold">Quantity:</span> {{ $detail->quantity }}</div>
              </div>
          @endforeach               
          @endforeach             
      </div>          
    </div>    
  </div>
@endsection