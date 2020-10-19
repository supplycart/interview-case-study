<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Supplycart</title>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">

    <!-- Styles -->
</head>

<body class="bg-white antialiased">
    <div id="app">
      <the-header></the-header>
      <master/>
    </div>
    <script src=" /js/app.js?v={{ time() }}"></script>
</body>

</html>