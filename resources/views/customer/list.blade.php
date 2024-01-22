<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>
</head>
<body>
    <table>
        <tr>
            <td>Customer ID</td>
            <td>Name</td>
            <td>Status</td>
            <td>Created at</td>
        </tr>
        @foreach ($customer_list as $$customer)
        <tr>
            <td>{{ $customer->cus_id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->status }}</td>
            <td>{{ $customer->created_at }} at</td>
        </tr>
        @endforeach
    </table>
</body>
</html>