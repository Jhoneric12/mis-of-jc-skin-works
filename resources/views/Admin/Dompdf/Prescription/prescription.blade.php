<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
        /* Add your CSS styles here for better layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid green;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: green;
            color: white;
            padding: 15px;
            margin: 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .header h1, .header p {
            margin: 5px 0;
        }
        .patient {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .doctor {
            margin-top: 20px;
            text-align: right;
        }
        .footer {
            background-color: green;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .footer p {
            margin: 5px 0;
        }
        .content h1 {
            margin: 0 0 10px;
        }
        .content p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>JC's Skinworks Dermatology Clinic</h1>
            <p>2/F, 173-D, Dr. Francisco F. Ingal's Bldg. M.L. Quezon Ave. Brgy. San Isidro, Angono, Rizal</p>
            <p>Phone: 285645507 | Email: jcskinworks777@gmail.com</p>
        </div>

        <div class="patient">
            <p><strong>Patient Name:</strong> {{ $data['patient_name'] }}</p>
            <p><strong>Gender:</strong> {{ $data['gender'] }}</p>
            <p><strong>Skin Type:</strong> {{ $data['skin_type'] }}</p>
            <p><strong>Age:</strong> {{ $data['age'] }}</p>
        </div>

        <div class="content">
            <h1>Rx</h1>
            <p>{{ $data['medication'] }}</p>
            <p><strong>Description:</strong> <br>{{ $data['description'] }}</p>
        </div>

        <div class="doctor">
            <p>{{ $data['specialist_name'] }}<br><strong>Doctor's Name</strong></p>
            <p>{{ $data['license_number'] }} <br> <strong>License Number</strong></p>
        </div>

        <div class="footer">
            <p>"Working together to bring out the beauty within."</p>
        </div>
    </div>
</body>
</html>
