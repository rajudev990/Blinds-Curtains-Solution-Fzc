
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
        
        /*table, th, td {*/
        /*  border: 1px solid black;*/
        /*}*/
        /*th{*/
        /*    width: 30%;*/
        /*    text-align: left;*/
        /*}*/
        /*td{*/
        /*    width: 70%;*/
        /*    padding-left: 8px;*/
        /*}*/
        
        table {
          border-collapse: collapse;
          width: 100%;
        }
        
        th, td {
          padding: 8px;
          text-align: left;
          border: 1px solid #DDD;
        }
        
        tr:hover {background-color: #D6EEEE;}
    </style>
</head>
<body>



    <p style="color:#053669;margin-top:15px;margin-bottom:10px;font-size:15px;font-weight:bold;">Dear {{ $order->book->name}},</p>
    
    <p style="color:#982F6A;margin-top:10px;font-size:22px;font-weight:bold;">Thank you for your payment. We’re happy to confirm that your Order Id <span style="color:#053669">{{ $order->order_code }}</span> is now in production.</p>
    
        <p style="margin-top:10px;font-size:16px;">Once it’s ready, we’ll send you a quick link to schedule your installation.</p>
    
     <p style="margin-top:10px;margin-bottom:20px;font-size:16px;color:#053669;">If you need anything in the meantime, feel free to reach out!</p>
     
     {{--<p style="margin-top:30px;font-size:15px;margin-bottom:30px;color:#fff !important;"><a style="background-color:#982F6A;color: #fff !important;padding:15px 8px;text-decoration:none;" class="btn-payment" href="{{ route('admin.order.invoice',$order->order_code) }}">Invoice View</a></p>--}}
     
    
    <p style="margin-top:15px;font-size:15px;">Best regards,</p>
    <p style="font-size:15px;">Blinds & Curtains Solution Fzc</p>
    
     <div class="text-align:center;" style="margin-top:5px;margin-bottom:10px;">
        <img src="{{ asset('frontend/curtain.png') }}" style="width: 175px;height:auto;margin:auto;" />
    </div>
    <p style="font-size:14px;margin-bottom:2px;">Phone : +971 56 127 8800</p>
 
    
    <h1 style="background-color:#053669;color:#982F6A;padding:15px;text-align:center;margin-top:10px;">Blinds & Curtains Solution Fzc</h1>
    
    
    
</body>
</html>