<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th,
        .invoice-items td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>

        <div class="invoice-details">
            <p><strong>Invoice Number:</strong> {{ $invoice->id }}</p>
            <p><strong>Date:</strong> {{ $invoice->created }}</p>
            <!-- Add more invoice details here as needed -->
        </div>

        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['quantity'] * $product['price'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-total">
            <p><strong>Subtotal:</strong> {{ $subtotal }}</p>
            <p><strong>Tax:</strong> {{ $tax }}</p>
            <p><strong>Total:</strong> {{ $total }}</p>
        </div>
    </div>
</body>

</html>