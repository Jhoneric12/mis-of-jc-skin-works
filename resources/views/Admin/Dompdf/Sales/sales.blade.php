<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
            text-align: center;
        }
        .header img {
            width: 200px;
        }
        .invoice-id {
            font-size: 24px;
            margin-top: 10px;
        }
        .address-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .address {
            width: 45%;
            text-align: left;
        }
        .patient-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        .patient-table th, .patient-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
        .footer div {
            margin-top: 20px;
            font-style: italic;
            font-size: 10px;
        }
        .logo-name {
            font-size: 20px;
        }
        .header h2 {
            font-size: 12px;
            font-weight: 400;
        }
        .header p {
            background-color: #4FBD5E;
            width: 100%;
            padding: 1;
            color: white;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="logo-name">JC's Skin Works</h1>
            <h2>2/F, 173-D, Dr. Francisco F. Ingal's Bldg. M.L. Quezon Ave. Brgy. San Isidro, Angono, Rizal</h2>
            <p>Sales Report</p>
        </div>
    
        <table class="patient-table">
            <tr>
                <th>ID</th>
                <th>Recipient</th>
                <th>Total Amount</th>
                <th>Payment Mode</th>
                <th>Date</th>
            </tr>
            @foreach($data as $item)
            <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->patient->first_name . " " . $item->patient->last_name}}</td>
                    <td>{{ $item->total_amount}}</td>
                    <td>{{ $item->payment_mode}}</td>
                    <td>{{ $item->created_at}}</td>
            </tr>
            @endforeach
        </table>
    
        <div class="footer">
            <div>"Working Together to bring out the beauty within"</div>
            <p>Issued on {{ date('Y-m-d') }}</p>
            {{-- <div>&copy; Jc's Skin Works</div> --}}
        </div>
    </div>
</body>
</html>
