@extends('app')

@section('content')
    <div class="h-full bg-gray-100">
        <section class="header relative">
            <div class="bg-no-repeat bg-cover bg-center w-full" style="background-image:url({{ asset('images/header.jpg') }}); height: 500px"></div>
            <div class="bg-black w-full absolute top-0 left-0 opacity-20" style="height:500px"></div>
        </section>
        <section class="items flex items-center text-gray-600">
            <div class="container px-5 py-24 mx-auto">
                <div class="text-center mb-12">
                    <h5 class="text-base md:text-lg text-indigo-700 mb-1">See our latest products</h5>
                    <h1 class="text-4xl md:text-6xl text-gray-700 font-semibold">Brand new graphics cards</h1>
                </div>
                
                @if (session()->has('success'))
                <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mr-2 ml-2" role="alert">
                {{-- <strong class="font-bold">Holy smokes!</strong> --}}
                <span class="block sm:inline">{{ session()->get('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <button onclick="closeAlert()"><svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></button>
                </span>
                </div>
                @endif

                <div class="flex flex-wrap -m-4">
                    @if (empty($data)) 
                        <div class="text-center mx-auto">
                            <span class="italic text-gray-400">If you are seeing this, you prolly forgot to run php artisan db:seed</span>
                        </div>
                    @else
                    @foreach ($data as $product)
                    <div class="p-4 sm:w-1/2 lg:w-1/3">
                        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                            <img src="{{ asset('images/products/' .$product->image) }}" alt="image" class="bg-white lg:h-72 md:h-48 w-full object-cover object-center">
                            <div class="p-6 bg-indigo-700 text-white">
                                <h1 class="text-2xl font-semibold mb-3">{{ $product->name }}</h1>
                                <div class="flex item-center flex-wrap">
                                    <span class="text-white inline-flex items-center md:mb-2 lg:mb-0">RM{{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('add-cart', $product->id) }}" class="text-white inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none pl-3 pr-3 py-2 bg-green-500 rounded hover:bg-green-600 ">
                                        <span class="">Add to cart</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>          
            </div>
        </section>
    </div>
@endsection