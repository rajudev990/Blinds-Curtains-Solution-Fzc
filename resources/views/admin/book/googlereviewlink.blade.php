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

    <p style="color:#053669;margin-top:15px;margin-bottom:10px;font-size:15px;font-weight:bold;">Dear {{ $data->book->name }},</p>
    
    <p style="margin-top:30px;font-size:15px;margin-bottom:30px;">We would like to express our sincere appreciation for choosing Blinds & Curtains Solution for your order ID {{ $data->order_code }} We trust that you are satisfied with your new blinds/curtains.</p>
    
    
    
    <p style="margin-top:10px;font-size:15px;color:#053669;">Should you encounter any issues or require further assistance, please do not hesitate to contact us. We are here to assist you.</p>
    
    <p style="margin-top:30px;font-size:15px;margin-bottom:30px;color:#000 !important;">If you are pleased with our service, we would be grateful if you could take a moment to share your experience by leaving a google review: <br><br> <br> <a target="_blank" style="color: #fff !important;" class="btn-payment" href="https://g.page/r/CVd284EcuEI0EBE/review">Rate Us Here</a></p>
    
     <p style="margin-top:10px;font-size:16px;">Thank you once again for your business. We look forward to the opportunity to serve you in the future.</p>
     
     
    
    
    
    <p style="margin-top:15px;font-size:15px;">Best regards,</p>
    <p style="font-size:15px;">Blinds & Curtains Solution Fzc</p>
    
     <div class="text-align:center;" style="margin-top:5px;margin-bottom:10px;">
        <img src="{{ asset('frontend/curtain.png') }}" style="width: 175px;height:auto;margin:auto;" />
    </div>
    <p style="font-size:14px;margin-bottom:2px;">Phone : +971 56 127 8800</p>
 
    
    <h1 style="background-color:#053669;color:#982F6A;padding:15px;text-align:center;margin-top:10px;">Blinds & Curtains Solution Fzc</h1>
    

    
</body>
</html>