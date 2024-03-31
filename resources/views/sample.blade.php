<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        /* CSS styles for the receipt */
        .receipt {
            width: 300px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .item {
            margin-bottom: 10px;
        }
        .item-name {
            font-weight: bold;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Receipt</h2>
        </div>
        {{-- <div class="details">
            <p>Patient ID: {{ $patient_id }}</p>
            <p>Patient Name: {{ $patient_name }}</p>
            <p>Payment Mode: {{ $payment_mode }}</p>
        </div> --}}
        <div class="items">
            <table>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                @foreach ($data as $item)
                    <tr class="item">
                        <td class="item-name">{{ $item['quantity'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['price'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{-- <div class="total">
            <p>Total: {{ $total_amount }}</p>
        </div> --}}
    </div>
</body>
</html>
