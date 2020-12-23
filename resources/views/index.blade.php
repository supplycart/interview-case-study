<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    </head>
    <body>
        <div id="app">
            <router-view :key="$route.fullPath"></router-view>
            <!-- <welcome></welcome> -->
        </div>
        <!-- <script src="js/manifest.js"></script>
        <script src="js/vendor.js"></script> -->
        <script src={{ asset('js/app.js') }}></script>
    </body>
</html>
