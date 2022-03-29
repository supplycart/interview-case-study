<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>SupplyCart Mall</title>
</head>
<body class="h-full">
<div id="app">
    <router-view></router-view>
</div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
