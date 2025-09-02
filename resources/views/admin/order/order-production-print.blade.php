<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order #{{ $order->order_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 380px; /* Matches paper width */
            height: auto; /* Matches paper height */
            margin: 0;
            box-sizing: border-box;
        }

        .invoice {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header, .footer {
            text-align: left;
            font-size: 12px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            text-align: left;
        }

        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 10px;
        }

        .items-table th {
            background-color: #f5f5f5;
        }

        .barcode img {
            display: block;
            margin: 5px auto;
            width: 100px;
        }

        @media print {
            body {
                width: 380px;
                height: auto;
                margin: 0;
                padding: 0;
            }

            .items-table th, .items-table td {
                font-size: 9px;
                padding: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="invoice">

        <!-- Table Section -->
        <table class="items-table">
            <tbody>
                <tr>
                    <td>
                        <strong>Customer Name:</strong> {{ $order->book->name ?? 'N/A' }}<br>
                        <strong>Address:</strong> {{ $order->book->address ?? 'N/A' }}<br>
                        <strong>Phone:</strong> {{ $order->book->phone ?? 'N/A' }}
                    </td>
                    <td>
                        <strong>Total Windows:</strong> {{ $order->OrderItems->where('order_type', 'windows')->count() }}<br>
                        <div class="barcode">
                            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode">
                        </div>
                    </td>
                </tr>
                @foreach ($order->OrderItems as $item)
                <tr>
                    <td>
                        @if ($item->order_type == 'accessories')
                            {{ $item->product->title ?? 'N/A' }}
                        @else
                            {{ $item->window_name ?? 'N/A' }}
                        @endif
                    </td>
                    <td>
                        {{ $item->width ?? 'N/A' }} Width X
                        @if ($item->order_type == 'accessories')
                            {{ $item->height ?? 'N/A' }} Height
                        @else
                            {{ max($item->height_left, $item->height_middle, $item->height_right) ?? 'N/A' }} Height
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
