@extends('layouts.app')

@section('content')
<div class="p-5">
    <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
        View Cart
    </div>
     <div class="flex h-64">
      <div class="relative ">
          <div class="flex flex-row cursor-pointer truncate p-2 px-4  rounded">
              <div></div>
              <div class="flex flex-row-reverse ml-2 w-full">
                  <div slot="icon" class="relative">
                      <div class="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-red-700 text-white">{{ $pendingOrdersCount }}</div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart w-6 h-6 mt-2">
                          <circle cx="9" cy="21" r="1"></circle>
                          <circle cx="20" cy="21" r="1"></circle>
                          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                      </svg>
                  </div>
              </div>
          </div>
          <div class="absolute w-full  rounded-b border-t-0 z-10">
              <div class="shadow-xl w-64">
                  <form class="mt-6" method="POST" action={{ URL('orders') }}>  
                    @csrf
                    @foreach($pendingOrders as $pendingOrder) 
                    <div class="p-2 flex bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-100" style="">
                        <input type="checkbox" hidden checked name= "selected[]"  value= {{ $pendingOrder->id }}>
                        <div class="p-2 w-12"><img src="https://dummyimage.com/50x50/bababa/0011ff&amp;text=50x50" alt="img product"></div>
                        <div class="flex-auto text-sm w-32">
                            <div class="font-bold">{{ $pendingOrder->productName }}</div>                          
                            <div class="text-gray-400">Qt: {{ $pendingOrder->quantity }}</div>
                        </div>
                        <div class="flex flex-col w-18 font-medium items-end">
                            <div class="w-4 h-4 mb-6 hover:bg-red-200 rounded-full cursor-pointer text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 ">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </div>
                            ${{ $pendingOrder->productPrice }}</div>
                    </div>   
                    @endforeach                                
                    <div class="p-4 justify-center flex">
                        <button class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
                          hover:bg-teal-700 hover:text-teal-100 
                          bg-teal-100 
                          text-teal-700 
                          border duration-200 ease-in-out 
                          border-teal-600 transition">Place Order ${{ $totalPrice }}</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <div class="h-32"></div>
</div>
@endsection