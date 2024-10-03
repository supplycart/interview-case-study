<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    @section("meta")
    @show

    <title>@yield('title')</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all"/>

    @section("style")
    @show

</head>

<body id="web">

    {{-- @include('web.layouts.header') --}}
    @yield('content')
    {{-- @include('web.layouts.footer') --}}


    <!-- Bootstrap core JavaScript -->
    <script src="../web/vendor/jquery/jquery.min.js"></script>

    <script src="../web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    @section("script")
    @show

</body>

</html>
