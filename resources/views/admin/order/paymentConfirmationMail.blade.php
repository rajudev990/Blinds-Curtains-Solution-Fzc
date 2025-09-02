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
        .btn-payment{
            background-color: red;
            padding: 15px 8px;
            font-size: 18px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <p style="color:#053669;margin-top:15px;margin-bottom:10px;font-size:15px;font-weight:bold;">Dear {{ $data['name'] }},</p>
    
    <p style="margin-top:30px;font-size:15px;margin-bottom:30px;">We hope you are enjoying your new blinds/curtains. This is a friendly reminder that the remaining balance for your order ID: [<span style="font-weight: bold;">{{ $data['order_code'] }}</span>] is still outstanding.
    </span></p>
    
    <p style="margin-top:10px;font-size:15px;">Please use the following link to complete your payment at your earliest convenience:
    </p>
    

    
    <p style="margin-top:10px;font-size:15px;color:#053669;">If you have any questions or need assistance, please feel free to contact us. Thank you for your prompt attention to this matter.</p>
    
    <p style="margin-top:15px;font-size:15px;">Sincerely,</p>
    <p style="font-size:15px;">Blinds & Curtains Solution Fzc</p>
    
     <div class="text-align:center;" style="margin-top:5px;margin-bottom:10px;">
        <img src="{{ asset('frontend/curtain.png') }}" style="width: 175px;height:auto;margin:auto;" />
    </div>
    <p style="font-size:14px;margin-bottom:2px;">Phone : +971 56 127 8800</p>
 
    
    <h1 style="background-color:#053669;color:#982F6A;padding:15px;text-align:center;margin-top:10px;">Blinds & Curtains Solution Fzc</h1>
    

    
</body>
</html>