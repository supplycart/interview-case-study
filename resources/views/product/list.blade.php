<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
</head>
<body>
    <table>
        <tr>
            <td>Product ID</td>
            <td>Name</td>
            <td>Price</td>
            <td>Status</td>
            <td>Created at</td>
        </tr>
        @foreach ($product_list as $product)
        <tr>
            <td>{{ $product->product_id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>