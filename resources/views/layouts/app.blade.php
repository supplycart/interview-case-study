<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SupplyTruck</title>
	<link href="/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <script src={{ asset('js/app.js') }} defer></script>
</head>
<header>
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="hidden w-full text-gray-600 md:flex md:items-center">
                </div>

                <div class="w-auto text-gray-700 md:text-center text-2xl font-semibold">
                    <a href="{{ url('app') }}">
                        <x-application-logo/> SupplyTruck
                    </a>
                </div>
                <div class="flex items-center justify-end w-full">
                </div>
            </div>
            <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{ route('app') }}">Home</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{ route('cart') }}">Cart</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Orders</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" type="submit">
                            Logout
                        </button>
                </form>

                </div>
            </nav>
        </div>
    </header>
    @yield('content')
    <footer class="bg-gray-200">
        <div class="mx-auto px-6 py-6 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">SupplyTruck</a>
            <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
        </div>
    </footer>
</html>