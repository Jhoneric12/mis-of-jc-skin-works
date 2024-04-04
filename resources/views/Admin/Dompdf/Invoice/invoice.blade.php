<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>Invoice</title>
    <style>
       body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 1.5rem
        }
        .header h1 {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .header p {
            font-size: 0.8rem;
            font-weight:200;
        }

        /* .or {
            font-size: 1.2rem
            width: 100%;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: white;
            background-color: #4FBD5E;
            padding: 1
        } */

        .patient-details {
            margin-bottom: 1.5rem;
        }

        .patient-details, h1 {
            font-size: 0.8rem;
        }

        .table-auto {
        width: auto;
        border-collapse: collapse;
        border: 1px solid #4FBD5E;
        margin-bottom: 24px;
        }

        .table-auto th,
        .table-auto td {
            border: 1px solid #4FBD5E;
            padding: 8px 16px;
            text-align: left;
        }

        .header-cell {
            background-color: #4FBD5E;
            color: #ffffff;
            padding: 8px 16px;
        }

        .header-cell:first-child {
            border-top-left-radius: 4px;
        }

        .header-cell:last-child {
            border-top-right-radius: 4px;
        }

        .border {
            border: 1px solid #4FBD5E;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-right {
            text-align: right;
        }
        .billing-user h1 {
            color: #4FBD5E;
        }

        .table-container {
            width: 100%;
        }


    </style>
</head>
<body>
    <div class="overflow-x-auto">
        <div class="header">
            <h1>Jc's Skin Works Dermatology Clinic</h1>
            <p>2/F, 173-D, Dr. Francisco F. Ingal's Bldg. M.L. Quezon Ave. Brgy. San Isidro, Angono, Rizal</p>
            <p>Telephone : 285645507</p>
            <p>Email : jcskinworks777@gmail.com</p>
        </div>
        <span class="or">Official Receipt</span>
        <div class="mb-6">
            <div class="patient-details">
                <div>
                    <h1 class="font-medium">Order No: <span>{{$order_no}}</span></h1>
                </div>
                <div>
                    <h1 class="font-medium">Patient ID: <span>{{$patient_id}}</span></h1>
                </div>
                <div>
                    <h1 class="font-medium">Patient Name: <span>{{$patient_name}}</span></h1>
                </div>
            </div>
        </div>
        <div class="table-container">
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="header-cell">Particulars</th>
                        <th class="header-cell">Quantity</th>
                        <th class="header-cell">Unit Price</th>
                        <th class="header-cell">Sub-Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    ?>
                    @foreach($cart as $index => $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item['name'] }}</td>
                        <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                        <td class="border px-4 py-2">{{ number_format($item['total'] / $item['quantity'], 2) }}</td>
                        <td class="border px-4 py-2">{{ $item['subtotal'] }}</td>
                    </tr>
                    @endforeach
                    <!-- Total row -->
                    <tr>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2 text-right"><strong>Discount</strong></td>
                        <td class="border px-4 py-2">{{ number_format($discount, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2 text-right"><strong>Total</strong></td>
                        <td class="border px-4 py-2">{{ number_format($total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2 text-right"><strong>Payment Mode</strong></td>
                        <td class="border px-4 py-2">{{ $payment_mode }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            <div class="flex flex-col gap-1">
                <div class="billing-user">
                    <h1 class="font-medium text-green-400">Billing User:</h1>
                    <span>{{Auth::user()->first_name . " " . Auth::user()->last_name}}</span>
                </div>
                <div class="billing-user">
                    <h1 class="font-medium text-green-400">Date:</h1>
                    <span>{{ \Carbon\Carbon::today()->format('F j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
