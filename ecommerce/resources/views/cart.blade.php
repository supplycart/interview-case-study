@extends('app')

@section('title', 'Cart')

@section('content')
    <main class="my-8">
        <div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    @if ($message = Session::get('success'))
                        <div class="p-4 mb-3 bg-green-400 rounded">
                            <p class="text-green-800">{{ $message }}</p>
                        </div>
                    @endif

                    <h3 class="text-3xl text-bold">Cart List</h3>
                    <div class="flex-1">
                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                        <thead>
                            <tr class="h-12 uppercase">
                                <th class="hidden md:table-cell"></th>
                                <th class="text-left">Name</th>
                                <th class="pl-5 text-left lg:text-right lg:pl-0">
                                    <span class="lg:hidden" title="Quantity">Qtd</span>
                                    <span class="hidden lg:inline">Quantity</span>
                                </th>
                                <th class="hidden text-right md:table-cell"> Price</th>
                                <th class="hidden text-right md:table-cell"> Remove </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="hidden pb-4 md:table-cell">
                                    <a href="#">
                                        <img src="{{ $item->attributes->image }}" class="w-20 h-20 rounded" alt="Thumbnail">
                                    </a>
                                </td>

                                <td>
                                    <a href="#">
                                        <p class="mb-2 md:ml-4">{{ $item->name }}</p>
                                    </a>
                                </td>

                                <td class="justify-center mt-6 md:justify-end md:flex">
                                    <div class="h-10 w-28">
                                        <div class="relative flex flex-row w-full h-8">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}" >
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-6 text-center bg-gray-300" />
                                                <button type="submit" class="px-2 pb-2 ml-2 text-white bg-blue-500">update</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                                <td class="hidden text-right md:table-cell">
                                    <span class="text-sm font-medium lg:text-base">
                                        ${{ $item->price }}
                                    </span>
                                </td>

                                <td class="hidden text-right md:table-cell">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="px-4 py-2 text-white bg-red-600">x</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                             
                          </tbody>
                        </table>
                        <div>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button class="px-6 py-2 text-red-800 bg-red-300">Clear the Cart</button>
                            </form>
                        </div>
                        <div> Total: ${{ Cart::getTotal() }} </div>
                        <div>
                            <form action="{{ route('order.place') }}" method="POST">
                                @csrf
                                <button class="px-6 py-2 text-white bg-blue-500">Place Order</button>
                            </form>
                        </div>  
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
@endsection