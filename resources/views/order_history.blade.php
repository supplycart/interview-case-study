<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product List</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            .d-none {
                display: none;
            }
        </style>
    </head>
    <body>
        <form action="{{ route('product_list') }}" method="get">
            <input type="submit" value="Back To Product List" />
        </form>
        <div>Total Price: {{ $total }}</div>
        @foreach ($order as $currOrder)
            <div class="js-products">
                <div>{{ $currOrder['product_name'] }} || {{ $currOrder['brand_name'] }} || {{ $currOrder['category'] }} || {{ $currOrder['product_price'] }}</div>
            </div>
        @endforeach
    </body>
</html>
