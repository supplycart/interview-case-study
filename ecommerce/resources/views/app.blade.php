<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-white">
        <header>
            <div class="container px-6 py-3 mx-auto">
                <div class="flex items-center justify-between">                    
                    <div class="flex items-center justify-end w-full">
                        <button" class="mx-4 text-gray-600 focus:outline-none sm:mx-0"></button>
                    </div>
                </div>
                <nav class="p-6 mt-4 text-white bg-black sm:flex sm:justify-center sm:items-center">
                    <div class="flex flex-col sm:flex-row">
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('login') }}">Login</a>
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('register-user') }}">Register</a>
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('dashboard') }}">Shop</a>
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('signout') }}">Logout</a>
                    </div>
                </nav>
            </div>
        </header>
        
        <main class="my-8">
            @yield('content')
        </main>
    
    </div>
</body>
</html>