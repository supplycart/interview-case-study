<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction List</title>
</head>
<body>
    <table>
        <tr>
            <td>Transaction ID</td>
            <td>Order ID</td>
            <td>Price</td>
            <td>Status</td>
            <td>Status Code</td>
            <td>Created at</td>
        </tr>
        @foreach ($transaction_list as $transaction)
        <tr>
            <td>{{ $transaction->transaction_id }}</td>
            <td>{{ $transaction->order_id }}</td>
            <td>{{ $transaction->price }}</td>
            <td>{{ $transaction->status }}</td>
            <td>{{ $transaction->code }}</td>
            <td>{{ $transaction->created_at }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>