<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Record Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #f0f0f0; */
            padding: 20px;
        }
        .certificate {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            /* border: 2px solid #5FC26C; */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 1;
            background-color: #5FC26C;
        }
        .header h1 {
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            color: #5FC26C;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .section-content {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
        }
        .footer p {
            margin-bottom: 10px;
            font-size: 10px
        }
        .medication .section-title {
            color: red;
        }
        .prescription .section-title {
            font-size: 1.5rem;
            color: black;
        }
        .company .logo-name {
            font-size: 20px;
        }
        .company h2, .company p {
            font-size: 12px;
            font-weight: 400;
        }
        .company {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer div {
            margin-top: 20px;
            font-style: italic;
            font-size: 10px;
        }

    </style>
</head>
<body>
    <div class="certificate">
        <div class="company">
            <h1 class="logo-name">JC's Skin Works</h1>
            <h2>2/F, 173-D, Dr. Francisco F. Ingal's Bldg. M.L. Quezon Ave. Brgy. San Isidro, Angono, Rizal</h2>
            <p>jcskinworks777@gmail.com</p>
            <p>09338281476</p>
        </div>
        <div class="header">
            <h1>Medical Record</h1>
        </div>
        <div class="section">
            <h2 class="section-title">Patient Information</h2>
            <div class="section-content">
                <p><strong>Name:</strong> {{$data['fullname']}}</p>
                <p><strong>Contact Number:</strong> {{$data['contact_number']}}</p>
                <p><strong>Email:</strong> {{$data['email']}}</p>
                <p><strong>Home Address:</strong> {{$data['home_address']}}</p>
                <p><strong>Skin Type:</strong> {{$data['skintype']}}</p>
            </div>
        </div>
        <div class="medication">
            <h2 class="section-title">Medication Allergies</h2>
            <div class="section-content">
                <p>{{$data['medication_allergies']}}</p>
            </div>
        </div>
        <div class="section">
            <h2 class="section-title">Findings</h2>
            <div class="section-content">
                <p>{{$data['findings']}}</p>
            </div>
        </div>
        <div class="prescription">
            <h2 class="section-title">Rx</h2>
            <div class="section-content">
                <p>{{$data['prescription']}}</p>
            </div>
        </div>
        <div class="footer">
            <div>"Working Together to bring out the beauty within"</div>
            <p>Issued on {{ date('Y-m-d') }}</p>
            {{-- <div>&copy; Jc's Skin Works</div> --}}
        </div>
    </div>
</body>
</html>
