<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blinds & Curtains Solution Fzc </title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: tahoma sans-serif;
            margin: 20px;
            padding: 10px;
        }
        
        table, th, td {
          border: 1px solid black;
        }
        th{
            width: 30%;
            text-align: left;
            padding:10px;
        }
        td{
            width: 70%;
            padding:10px;
        }
    </style>
</head>
<body>

    <h1 style="background-color:#053669;color:#982F6A;padding:15px;text-align:center;margin-bottom:7px;">Blinds & Curtains Solution Fzc</h1>

    <div class="text-align:center">
        <img src="{{ asset('frontend/curtain.png') }}" style="width: 175px;height:auto;margin:auto;" />
    </div>

    <h2 style="color:green;margin-top:15px;margin-bottom:15px;">Hello B&C! New Book Confirm From - {{ $newAdminData['name'] }}</h2>
    
    <table style="width: 100%;border:1px solid black;border-collapse: collapse;padding-top:15px;">
        <tr>
            <th>Booking ID</th>
            <td>{{ $newAdminData['book_id'] }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ \Carbon\Carbon::parse($newAdminData['booking_date'])->format('Y-m-d') }}</td>
        </tr>
        <tr>
            <th>Booking Slot</th>
            <td>{{ $newAdminData['booking_time_id'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $newAdminData['name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $newAdminData['email'] }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $newAdminData['phone'] }}</td>
        </tr>
        <tr>
            <th>Community / Building Name</th>
            <td>{{ $newAdminData['address'] }}</td>
        </tr>
        <tr>
            <th>Falt No / Villa No</th>
            <td>{{ $newAdminData['flat_no'] }}</td>
        </tr>
        <tr>
            <th>Windows No</th>
            <td>{{ $newAdminData['windows_number'] }}</td>
        </tr>
        <tr>
            <th>Blinds/Curtains Type</th>
            <td>{{ $newAdminData['type'] }}</td>
        </tr>
    </table>

    
</body>
</html>