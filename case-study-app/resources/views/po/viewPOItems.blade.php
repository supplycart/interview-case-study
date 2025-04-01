<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield("title", "Purchase Order Items")</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
        </style>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <nav class="bg-sky-500 border-gray-500 dark:bg-blue-800">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{route("home")}}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                        CartAdder2025
                    </span>
                </a>
                <div class="w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg 
                    bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 
                    md:dark:bg-transparent dark:border-gray-700">
                        <li>
                            <a href="{{route("home")}}" 
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 
                            dark:text-white md:dark:hover:text-amber-500 dark:hover:bg-gray-700 
                            dark:hover:text-white md:dark:hover:bg-transparent">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="{{route("viewCart")}}" 
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 
                            dark:text-white md:dark:hover:text-amber-500 dark:hover:bg-gray-700 
                            dark:hover:text-white md:dark:hover:bg-transparent">
                                Cart
                            </a>
                        </li>
                        <li>
                            <a href="{{route("viewPO")}}"
                            class="block py-2 px-3 text-white bg-amber-500 
                            rounded-sm md:bg-transparent md:text-amber-600 md:p-0 
                            dark:text-white md:dark:text-amber-500" aria-current="page">
                                Purchase Orders
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <form action="{{route("updateOrder")}}" method="POST" class="space-y-6" id="itemForm">
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
                        @foreach($cartItems as $ci)
                            <tr class="bg-white border-b dark:bg-gray-400 dark:border-gray-700 border-gray-200">
                                <td>{{$product[$ci->id_product]->product_name}}</td>
                                <td>{{$product[$ci->id_product]->product_price}}</td>
                                <td>
                                    <input type="number" readonly
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                                    border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                                    focus:bg-white focus:border-gray-500 qty_input" 
                                    id="{{$ci->id."_qty"}}" name="qty[{{$ci->id}}]" value="{{$ci->quantity}}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="po" value="{{$purchaseOrder->id}}">
            <div class="w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg 
                bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 
                md:dark:bg-transparent dark:border-gray-700">
                    <li>
                        <button type="submit" name="action" value="completePO"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold 
                        text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 
                        focus-visible:outline-indigo-600">
                            Complete Purchase Order
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="action" value="cancelPO"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold 
                        text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 
                        focus-visible:outline-indigo-600">
                            Cancel Purchase Order
                        </button>
                    </li>
                </ul>
            </div>
        </form>
    </body>

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
</html>
