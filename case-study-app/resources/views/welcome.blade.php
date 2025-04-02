@extends('layouts.homeLayout')
@section('content')
    <form action="{{route("addToCart")}}" method="POST" class="space-y-6" id="itemForm">
        @csrf
        <div class="w-full max-w-4/5 content-between">
            <table class="table-auto w-full text-md text-left rtl:text-right text-black dark:text-black">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-400 dark:border-gray-700 border-gray-200">
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>
                                <input type="number" 
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                                border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                                focus:bg-white focus:border-gray-500 qty_input" 
                                id="{{$product->id."_qty"}}" name="qty[{{$product->id}}]">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" 
        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold 
        text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 
        focus-visible:outline-indigo-600">
            Add to Cart
        </button>
    </form>
@endsection

@section('js')
    <script>
        var myForm = document.getElementById('itemForm');

        myForm.addEventListener('submit', function () {
            var allInputs = myForm.getElementsByTagName('input');

            for (var i = 0; i < allInputs.length; i++) {
                var input = allInputs[i];

                if (input.name && !input.value) {
                    input.name = '';
                }
            }
        });
    </script>
@endsection
