<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield("title", "Purchase Orders")</title>

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
        @if(session()->has("success"))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" 
            role="alert">
                {{session()->get("success")}}
            </div>
        @endif
        <div class="w-full max-w-4/5 content-between">
            <table class="table-auto w-full text-md text-left rtl:text-right text-black dark:text-black">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th>#</th>
                        <th>Issue Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrder as $key => $po)
                        <tr class="bg-white border-b dark:bg-gray-400 dark:border-gray-700 border-gray-200">
                            <td>{{$key + 1}}</td>
                            <td>{{$po->created_at}}</td>
                            <td>
                                {{$po->status == 0?"New":
                                ($po->status == 1?"Sent":
                                ($po->status == 2?"Complete":"Cancelled"))}}
                            </td>
                            <td>
                                <a href="{{route("viewPOItems" ,['id' => $po->id_cart])}}"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold 
                                text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 
                                focus-visible:outline-indigo-600">
                                    View Purchase Order
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
