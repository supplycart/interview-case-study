@extends('layouts.app')

@section('content')
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="flex justify-center my-6">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="flex-1">

                    @if(session()->has('success'))
                        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                            <span class="inline-block align-middle mr-8">
                                {{ session()->get('success') }}
                            </span>
                        </div>
                    @endif

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
                        @foreach($items as $item)
                            <tr>
                                <td class="hidden pb-4 md:table-cell">
                                    <a href="{{ route('product.view', [$item->product]) }}">
                                        <img src="{{ $item->product->image_src }}" class="w-20 rounded" alt="Thumbnail">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('product.view', [$item->product]) }}">
                                        <p class="mb-2 md:ml-4">{{ $item->product->name }}</p>
                                        <form action="{{ route('cart.remove', [$item]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-gray-700 md:ml-4">
                                                <small>(Remove item)</small>
                                            </button>
                                        </form>
                                    </a>
                                </td>
                                <td class="justify-center md:justify-end md:flex mt-6">
                                    <div class="w-20 h-10">
                                        <div class="relative flex flex-row w-full h-8">
                                            <input type="number" value="{{ $item->quantity }}"
                                                   class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" readonly/>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                  <span class="text-sm lg:text-base font-medium">
                                    MYR {{ $item->product->product_price }}
                                  </span>
                                </td>
                                <td class="text-right">
                                  <span class="text-sm lg:text-base font-medium">
                                    MYR {{ number_format($item->sub_total, 2) }}
                                  </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr class="pb-6 mt-6">
                    <div class="my-4 mt-6 -mx-2 lg:flex">
                        <div class="lg:px-2 lg:w-1/2">
                            &nbsp;
                        </div>
                        <div class="lg:px-2 lg:w-1/2">
                            <div class="p-4 bg-gray-100 rounded-full">
                                <h1 class="ml-2 font-bold uppercase">Order Details</h1>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                        Total
                                    </div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                        MYR {{ $items->sum('sub_total') }}
                                    </div>
                                </div>
                                <a href="#">
                                    <form action="{{ route('cart.checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                            <span class="ml-2 mt-5px">Place Order</span>
                                        </button>
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
