<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('title')       
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>

        @include('layouts.modules.header')

        <!-- strat wrapper -->
        <div class="h-screen flex flex-row flex-wrap">
        
            @include('layouts.modules.sidebar')
        
            <!-- strat content -->
            <div class="bg-gray-100 flex-1 p-6 md:mt-16" id="app"> 
                @yield('content')
            </div>
            <!-- end content -->
        
        </div>
        <!-- end wrapper -->
     
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
