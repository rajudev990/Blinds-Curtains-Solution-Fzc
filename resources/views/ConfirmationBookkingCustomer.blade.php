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
        }
        td{
            width: 70%;
            padding-left: 8px;
        }
    </style>
</head>
<body>


    <p style="color:#053669;margin-top:15px;margin-bottom:10px;font-size:15px;font-weight:bold;">Dear {{ $data['name'] }},</p>
    
    <p style="color:#982F6A;margin-top:10px;font-size:22px;font-weight:bold;">Congratulations! Your booking is confirmed under the Booking ID <span style="color:#053669">{{ $data['book_id'] }}</span>.</p>
    
    <p style="margin-top:10px;font-size:15px;">Our of our expert will call you one hour before arrival to confirm your availability, Keep your phone handy. we can’t wait to enhance your space and elevate your home!</p>
    
    
    <p style="margin-top:10px;font-size:15px;color:#053669;">Booking Date : {{ \Carbon\Carbon::parse($data['booking_date'])->format('Y-m-d') }}</p>
    <p style="margin-top:10px;font-size:15px;color:#053669;">Booking Slot : {{ $data['booking_time_id'] }}</p>
    
    <p style="margin-top:15px;font-size:15px;">Warmest regards,</p>
    <p style="font-size:15px;">{{ $data['website_name'] }}</p>
    
     <div class="text-align:center;" style="margin-top:5px;margin-bottom:10px;">
        <img src="{{ asset('frontend/curtain.png') }}" style="width: 175px;height:auto;margin:auto;" />
    </div>
    <p style="font-size:14px;margin-bottom:2px;">Phone : {{ $data['phone'] }}</p>
    <!--<p>Address {{ $data['address'] }}</p>-->
    
    
    <h1 style="background-color:#053669;color:#982F6A;padding:15px;text-align:center;margin-top:10px;">Blinds & Curtains Solution Fzc</h1>
    

    
</body>
</html>