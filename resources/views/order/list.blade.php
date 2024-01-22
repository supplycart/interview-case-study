<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order List</title>
</head>
<body>
    <table>
        <tr>
            <td>Order ID</td>
            <td>Product ID</td>
            <td>Product Price</td>
            <td>Status</td>
            <td>Order Complete</td>
            <td>Created at</td>
        </tr>
        @foreach ($order_list as $order)
        <tr>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->product_id }}</td>
            <td>{{ $order->order_price }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->order_complete }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>