@extends('layouts.app')

@section('content')
<div>
    <h3 class="text-center">All Products</h3><br/>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($products as $product)
        <div>
            <button type="submit" class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden text-left add-to-cart " data-name="{{$product->name}}" data-price="{{$product->price}}">
                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                </div>
                <div class="px-5 py-3 space-y-3">
                    <h3 class="text-gray-700 uppercase font-semibold" >{{$product->name }}</h3>
                    <p class="text-blue-500 text-sm font-semibold">{{ $product->brand }}</p>
                    <p class="text-blue-700 text-sm font-semibold">{{ $product->category }}</p>
                    <p class="text-gray-500 text-sm">{{ $product->descriptions }}</p>
                    <p class="text-red-500 mt-2"> RM {{ $product->price }}</p>
                </div>
            </button>
        </div>
        @endforeach
    </div>
</div>
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-8/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="font-bold">Cart</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <table class="show-cart table-auto w-50 text-right">
            
    </table>
    <div class="font-semibold py-3">Total price: $<span class="total-cart"></span></div>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
          <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
        </div>
        
      </div>
    </div>
  </div>

</div>
@endsection


