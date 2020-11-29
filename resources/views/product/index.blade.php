@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="mx-auto px-4 sm:px-8 py-2 text-center">

            {{--<div class="text-center max-w-lg mx-auto mt-6">--}}
            {{--    <div class="h-4 bg-gray-500 w-40 block mx-auto rounded-sm"></div>--}}
            {{--    <div class="h-2 bg-gray-400 w-64 mt-4 block mx-auto rounded-sm"></div>--}}
            {{--    <div class="h-2 bg-gray-400 w-48 mt-2 block mx-auto rounded-sm"></div>--}}
            {{--</div>--}}

            <div class="grid grid-cols-8 gap-4 items-start mt-8 mx-auto px-8">
                @foreach($products as $product)
                    <div class="col-span-8 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2">
                        <div class="bg-white shadow-lg rounded-lg px-4 py-6 mx-4 my-4">
                            <div class="mx-auto rounded-md">
                                <img src="{{ $product->image_src }}">
                            </div>
                            <div class="h-4 w-40 mt-3 block mx-auto rounded-sm">
                                <p class="text-center truncate">{{ $product->name }}</p>
                            </div>
                            <div class="h-2 w-35 mt-2 block mx-auto rounded-sm">
                                <p class="text-center truncate">MYR {{ $product->product_price }}</p>
                            </div>
                            <div class="flex justify-center mt-4">
                                <a href="{{ route('product.view', [$product]) }}" type="button" class="flex text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-center">View Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $products->links() }}
        </div>
    </main>
@endsection
