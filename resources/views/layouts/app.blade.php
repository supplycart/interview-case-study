<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>{{config('app.name', 'TEST')}}</title>                
    </head>
    <body>       
      @yield('content')
    </body>
</html>