@extends('layouts.app')

@section('content')
    <!-- component -->
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="{{ $product->image_src }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    {{--<h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2>--}}
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                    <p class="leading-relaxed">
                        {{ $product->description }}
                    </p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                        &nbsp;
                    </div>
                    <div class="flex">
                        <span class="title-font font-medium text-2xl text-gray-900">MYR {{ $product->price }}</span>
                        <button class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
