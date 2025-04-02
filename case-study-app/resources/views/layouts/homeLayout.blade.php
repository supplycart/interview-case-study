<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield("title", "Home")</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
        </style>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-amber-100">
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
                            <a href="{{route("home")}}" id="home"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 
                            dark:text-white md:dark:hover:text-amber-500 dark:hover:bg-gray-700 
                            dark:hover:text-white md:dark:hover:bg-transparent">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="{{route("viewCart")}}" id="viewCart"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 
                            dark:text-white md:dark:hover:text-amber-500 dark:hover:bg-gray-700 
                            dark:hover:text-white md:dark:hover:bg-transparent">
                                Cart
                            </a>
                        </li>
                        <li>
                            <a href="{{route("viewPO")}}" id="viewPO"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 
                            dark:text-white md:dark:hover:text-amber-500 dark:hover:bg-gray-700 
                            dark:hover:text-white md:dark:hover:bg-transparent">
                                Purchase Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{route("logout")}}"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 
                            dark:text-white md:dark:hover:text-amber-500 dark:hover:bg-gray-700 
                            dark:hover:text-white md:dark:hover:bg-transparent">
                                Logout
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

        <input type="hidden" id="currentRoute" value="{{Route::currentRouteName()}}">

        <div class="container">
            @yield('content')
        </div>

        @yield('js')
        <script>
            var route = document.getElementById("currentRoute").value;

            document.getElementById(route).className = "block py-2 px-3 text-white bg-amber-500 rounded-sm ";
            document.getElementById(route).className += "md:bg-transparent md:text-amber-600 md:p-0 ";
            document.getElementById(route).className += "dark:text-white md:dark:text-amber-500";

        </script>
    </body>
</html>