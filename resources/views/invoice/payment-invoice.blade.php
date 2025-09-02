<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{asset('frontend/logo.png')}}">
    <title>Invoice - {{ $order->order_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding: 20px;
            /* margin: 20px; */
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            font-weight: normal;
            position: relative;
        }

        .footer {
            background-color: #ECEFF4;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 10px;
        }

        .footer a {
            font-size: 15px;
            text-decoration: none;
        }

        .footer .right {
            float: right;
        }

        .footer .center {
            margin-left: 150px;
        }

        .footer .left {
            float: left;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header .inv-logo {
            margin: 0 auto;
        }

        .header .company-name {
            font-size: 20px;
            margin: 0px;
        }

        .header .address {
            margin-top: 0px;
            font-size: 14px;
        }

        .items {
            width: 100%;
            margin-top: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .date-info th,
        .date-info td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .date-info table {
            border-collapse: collapse;
        }

        .date-info .info-left {
            float: left;
        }

        .date-info .info-right {
            float: right;
        }

        .title {
            position: absolute;
            top: 7px;
            right: 6px;
            font-weight: bold;
            font-size: 20px;
            color: green;
        }
    </style>
</head>

<body style="position: relative;">

    <div class="header" style="padding-bottom: 40px;">
        <img src="{{ $logo }}" alt="logo" class="inv-logo" style="width:110px;">
        <h3 class="company-name" style="margin-top:0px;">Blinds & Curtains Solution Fzc</h3>
        <p class="address">DAQ Warehouse, Store-8M7, Al Quoz , Dubai & Abu Dhabi</p>
    </div>


    <div class="items">
        <table class="table">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Description</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Amount (AED)</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach ($order->OrderItems as $item)
                @if ($item->order_type == 'windows')
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>
                        {{ $item->window_name }} <br>
                        {{ $item->product->title }}
                    </td>
                    <td>
                        {{ $item->width }} CM
                    </td>
                    <td>
                        {{ max($item->height_left, $item->height_middle, $item->height_right) }} CM
                    </td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        @php
                        // Calculate the maximum height
                        $height = max(
                        $item->height_left ?? 0,
                        $item->height_middle ?? 0,
                        $item->height_right ?? 0
                        );

                        $windowTotal = 0; // Total for the main window

                        // Calculate the window total
                        $area = ($item->width * $height) / 10000; // Convert to square meters
                        $priceRate = $item->product->price_rate ?? 0;
                        $baseCharge = $item->product->base_charge ?? 0;
                        $additionalCharge = $item->product->additional_charge ?? 0;

                        if ($item->width > 280 && $height > 260) {
                        $windowTotal = $area * $priceRate + $baseCharge + $area * $additionalCharge;
                        } else {
                        $windowTotal = $area * $priceRate + $baseCharge;
                        }
                        @endphp
                        AED {{ number_format($windowTotal, 2) }}
                    </td>
                    <td style="text-align: right;">AED {{ number_format($windowTotal * $item->qty, 2) }}</td>
                </tr>
                @endif

                @php
                $relatedRows = $order->OrderItems->filter(function ($relatedItem) use ($item) {
                return $relatedItem->window_id == $item->id; // Match window_id with the current item's ID
                });
                @endphp

                @if ($relatedRows->isNotEmpty())
                @foreach ($relatedRows as $relatedRow)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>
                        {{ $item->window_name }} <br>
                        {{ $relatedRow->product->title }}
                    </td>
                    <td>
                        {{ $relatedRow->width }} CM
                    </td>
                    <td>
                        {{ $relatedRow->height }} CM
                    </td>
                    <td>{{ $relatedRow->qty }}</td>
                    <td>
                        @if ($relatedRow->product->cm_length == 'per piece')
                        AED
                        {{ number_format(($relatedRow->product->price_rate + $relatedRow->product->base_charge), 2) }}
                        @elseif($relatedRow->product->cm_length == 'per line meter')
                        AED
                        {{ number_format(($relatedRow->width / 100) * ($relatedRow->product->price_rate + $relatedRow->product->base_charge), 2) }}
                        @endif
                    </td>
                    <td style="text-align: right;">
                        @if ($relatedRow->product->cm_length == 'per piece')
                        AED
                        {{ number_format(($relatedRow->product->price_rate + $relatedRow->product->base_charge) * $relatedRow->qty, 2) }}
                        @elseif($relatedRow->product->cm_length == 'per line meter')
                        AED
                        {{ number_format(($relatedRow->width / 100) * ($relatedRow->product->price_rate + $relatedRow->product->base_charge) * $relatedRow->qty, 2) }}
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif

                @if ($item->order_type == 'accessories' && is_null($item->window_id))
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>
                        {{ $item->product->title }}
                    </td>
                    <td>
                        {{ $item->width }} CM
                    </td>
                    <td>
                        {{ $item->height }} CM
                    </td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        @if ($item->product->cm_length == 'per piece')
                        AED
                        {{ number_format(($item->product->price_rate + $item->product->base_charge), 2) }}
                        @elseif($item->product->cm_length == 'per line meter')
                        AED
                        {{ number_format(($item->width / 100) * ($item->product->price_rate + $item->product->base_charge), 2) }}
                        @endif
                    </td>
                    <td style="text-align: right;">
                        @if ($item->product->cm_length == 'per piece')
                        AED
                        {{ number_format(($item->product->price_rate + $item->product->base_charge) * $item->qty, 2) }}
                        @elseif($item->product->cm_length == 'per line meter')
                        AED
                        {{ number_format(($item->width / 100) * ($item->product->price_rate + $item->product->base_charge) * $item->qty, 2) }}
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>

            <tfoot>

             
                <tr>
                    <td colspan="6">Subtotal</td>
                    <td style="text-align: right;">

                        <span style="font-weight: bold;">AED {{ $order->order_subtotal }}</span>

                    </td>
                </tr>
                
                  @php
                // Convert order total safely
                $ordertotal = $order->order_total ? (float) preg_replace('/[^0-9.]/', '', $order->order_total) : 0.00;
                $paid = $order->orderDetails->sum('amount') ? (float) $order->orderDetails->sum('amount') : 0.00;
            
                // Initialize total and discount amount
                $total = $ordertotal;
                $discountAmount = 0;
                
            
                // Check for session coupon discount
                if (session('coupon_discount')) {
                    $discountPercent = (float) session('coupon_discount');
                    $discountAmount = ($total * $discountPercent) / 100;
                }
                
                if($order->coupon){
                    $discountPercent = (float) $order->coupon;
                    $discountAmount = ($total * $discountPercent) / 100;
                }
            
                // Apply discount
                $total = $total - $discountAmount;
                
            
                // Debugging final value
              
            @endphp
            
                <tr>
                    <td colspan="6">Vat</td>
                    <td style="text-align: right;"><span style="font-weight: bold;">AED 5.00 %</span>
                    </td>
                </tr>
                
                @if ($order->coupon)
                <tr>
                    <td colspan="6">Coupon</td>
                    <td style="text-align: right;"><span style="font-weight: bold;">{{ number_format($order->coupon, 2) }}%</span>
                    </td>
                </tr>
                @endif
                
            
            
                <tr>
                    <td colspan="6">Total
                        @if(!empty($order->order_coupon))
                        {{ $order->order_coupon }} % Discount
                        @endif
                        @if (!empty($order->coupon))
                        & {{ $order->coupon }} % Discount for Subscription
                        @endif

                    </td>
                    <td style="text-align: right;">

                        <span style="font-weight: bold;">AED {{ number_format($total, 2) }}</span>

                    </td>
                </tr>
                
                
                <tr>
                    <td colspan="6">Paid Amount</td>
                    <td style="text-align: right;"><span style="font-weight: bold;">AED {{ number_format($paid, 2) }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">Due Amount</td>
                    <td style="text-align: right;"><span style="color: green;font-weight:bold;">AED {{ number_format($total - $paid, 2) }}</span>
                    </td>
                </tr>
            </tfoot>


        </table>
    </div>


    <div style="clear: both;"></div>
    
    <div style="position: absolute;bottom:0px;width:100%;margin:0px;padding:0px;left:0px;">
        <div style="margin-left: 20px;margin-bottom:12px;">
            <p style="margin-bottom: 4px;">Blinds & Curtains Solution Fzc</p>
            <p style="margin-bottom: 4px;">DAQ Warehouse, Store-8M7, Al Quoz , Dubai & Abu Dhabi</p>
            <p><span style="font-weight: bold;margin-bottom: 4px;">Phone :</span> +971 56 127 8800</p>
            <p><span style="font-weight: bold;margin-bottom: 4px;">Email :</span> info@curtainssolutions.com</p>
        </div>
        <h2 style="background-color: #07386A;color:#982F6A;padding:10px;text-align:center;width:100%;">Blinds & Curtains Solution Fzc</h2>

    </div>



</body>

</html>