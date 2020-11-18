@extends('layouts.app')

@section('content')
<main class="my-8">
    <div class="container mx-auto px-6">
        <h3 class="text-gray-700 text-2xl font-medium text-center">My Orders</h3>
        @if(Session::has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mt-4" role="alert">
            <div class="flex">
                    <p class="font-bold">{{ Session::get('message') }}</p>
                
            </div>
        </div>
        @endif
        @foreach ($orders as $order)

        <div class="flex shadow-md my-10">
            <div class="w-full bg-white px-10">
                <div class="flex w-full items-center justify-between py-6 border-b">
                    <div class="flex font-bold uppercase">Order #{{$order->id}}</div>
                    <div class="font-normal text-gray-500 text-xs">Completed at {{$order->created_at}}</div>
                </div>
                @foreach ($order->orderItem as $item)
                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                    <div class="flex w-3/5">
                        <!-- product -->
                        <div class="w-20">
                            <img class="object-contain w-full h-20" src="{{$item->product->image_path}}" alt="">
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-sm">{{$item->product->name}}</span>
                            <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5">
                        <span class="text-center w-1/5 font-semibold text-sm">x {{$item->quantity}}</span>

                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">RM {{number_format($item->total, 2)}}</span>
                </div>
                @endforeach
                <div class="border-t py-6 flex w-full items-center justify-between px-8">
                    <div class="flex font-bold uppercase">Total</div>
                    <div class="font-normal font-bold ">RM {{number_format($order->total, 2)}}</div>
                </div>
            </div>


        </div>

        @endforeach
    </div>
    </div>
</main>
@endsection