<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
        /* Add your CSS styles here for better layout */
        .header {
            background-color: green;
            text-align: left;
            line-height: 5px;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            
        }
        .patient {
            border-bottom: 1px solid green;
            border-top: 1px solid green;
            text-align: left;
            font-size: 16px;
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 20px;
        }
        .content {
            text-align: left;
            font-size: 16px;
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 20px;
            gap: 40px;
        }
        .doctor{
            text-align: right;
            font-size: 16px;
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 100px;
        }
        .footer {
            text-align: center;
            background-color: green;
            color: white;
            margin-top: 20px;
        }
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>JC's Skinworks Dermatology Clinic</h1>
        <p>2/F, 173-D, Dr. Francisco F. Ingal's Bldg. M.L. Quezon Ave. Brgy. San Isidro, Angono, Rizal</p>
        <p>Phone: 285645507 | Email: jcskinworks777@gmail.com</p>
    </div>

    <div class="patient">
        <p>Patient Name: {{ $data['patient_name'] }}</p>
        <p>Gender: {{ $data['gender'] }}</p>
        <p>Skin Type: {{ $data['skin_type'] }}</p>
        <p>Age: {{ $data['age'] }}</p>
    </div>

    <div class="content">
        <h1>Rx</h1>
        <p>{{ $data['medication'] }}</p>
        <p><b>Description: </b><br>{{ $data['description'] }}</p>
    </div>

    <div class="doctor">
        <p>Doctor's Name: <br>{{ $data['specialist_name'] }}</p>
    </div>

    <div class="footer">
        <p>"Working together to bring out the beauty within."</p>
    </div>
</body>
</html>
