<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-200 min-h-screen font-base">
    <div id="app">
        <base-nav></base-nav>
        <main>
            <div class="container mx-auto pb-6 sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                <div class="px-4 sm:px-0">
                    @yield('content')
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
