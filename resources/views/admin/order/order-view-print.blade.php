<x-admin-app-layout>

    @section('title')
    Order Details
    @endsection
    @section('css')
    <style>
         @media print {
            /* Hide all elements except specified content */
            body * {
                visibility: hidden;
            }
            
            /* Only show order information */
            .print-content, .print-content * {
                visibility: visible;
            }
            
            /* Hide buttons and footer */
            .btn, footer {
                display: none !important;
            }
            /* Ensure barcodes are visible when printing */
            #orderBarcode, #bookBarcode {
                display: block !important;
            }
            
            /* Display the print content on the full page */
            /*.print-content {*/
            /*    position: absolute;*/
            /*    left: 0;*/
            /*    top: 0;*/
            /*    width: 100%;*/
            /*}*/
        }
    </style>
    @endsection

    @php
    $settins = \App\Models\Setting::first();
    @endphp


    <!-- Main content -->
    <section class="content pt-4 print-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-user"></i> {{ $order->book->name }} <span class="text-success">Order #{{ $order->order_code }}</span></h5>
                        Book ID: {{ $order->book->book_id }}, Email : {{ $order->book->email }}, Phone : {{ $order->book->phone }}, Community : {{ $order->book->address }}, Falt No : {{ $order->book->flat_no }}, Order Note : {{ $order->order_note }}
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <section class="content print-content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Items</h3>

                            <div class="order_details d-flex justify-content-end">
                                <h3 class="card-title mr-4">Cost</h3>
                                <h3 class="card-title mr-4">Qty</h3>
                                <h3 class="card-title">Total</h3>
                            </div>
                        </div>

                        <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    
                                    <th style="width: 25%">
                                        Project Name
                                    </th>
                                    
                                    
                                    <th style="width: 55%">
                                        Details
                                    </th>

                                    {{--<th style="width: 20%">
                                        Project Price
                                    </th>--}}
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->OrderItems as $row)
                                <tr>
                                   
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if ($row->product?->image !== null)
                                                <img class="img-fluid" style="width: 100px;height:100px;" src="{{ Storage::url($row->product->image) }}">
                                                @endif
                                            </li>
                                        </ul>
                                        <a>
                                            {{ $row->product?->title }}
                                        </a>
                                        <br />
                                        <strong>
                                            {{ $row->order_type }}
                                        </small>

                                        
                                        @if ($row->order_type == 'windows')
                                            @if($row->images)
                                            <br>
                                            <p class="mb-1 mt-2 text-primary">Catalogue Images</p>
                                                @foreach(json_decode($row->images) as $image)
                                                    <div class="border border-danger image-preview p-1 mr-1 mb-2 text-center" style="width: 75px; height:75px;float:left;">
                                                        <img src="{{ asset('uploads/order_items/' . $image) }}" class="img-fluid" width="100%" height="100%">
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </td>
                                    

                                    
                                    <td>
                                        @if ($row->order_type == 'windows')

                                        <span><span class="font-weight-bold">Width:</span> {{ $row->width }} cm, <span class="font-weight-bold">Left:</span> {{ $row->height_left }} cm,  <span class="font-weight-bold">Middle:</span> {{ $row->height_middle }} cm,  <span class="font-weight-bold">Right:</span> {{ $row->height_right }} cm</span> <br>


                                        <span><span class="font-weight-bold">SKU:</span> {{ $row->product->sku }}</span> <br>

                                        @foreach ($row->catalogueItems as $item)
                                        <div>
                                            <span class="font-weight-bold">Catalogue Name: </span>
                                            <span>{{ $item->catalogue->name ?? 'N/A' }}</span><br>

                                            <span class="font-weight-bold">Catalogue Book Name: </span>
                                            <span>{{ $item->catalogueBook->name ?? 'N/A' }}</span><br>

                                            <span class="font-weight-bold">Page Number: </span>
                                            <span>{{ $item->pageNumber->name ?? 'N/A' }}</span><br>
                                        </div>
                                        @endforeach

                                        <span><span class="font-weight-bold">Comment:</span> {{ $row->comment }}</span> <br>
                                        <span><span class="font-weight-bold">Fullness:</span> {{ $row->fullness }}</span> <br>
                                        <span><span class="font-weight-bold">Pooling:</span> {{ $row->polling }}</span> <br>
                                        <span><span class="font-weight-bold">Openning:</span> {{ $row->opening }}</span> <br>
                                        <span><span class="font-weight-bold">Lining:</span> {{ $row->lining }}</span> <br>

                                        
                                        @endif

                                        @if ($row->order_type == 'accessories')
                                            <span><span class="font-weight-bold">SKU:</span> {{ $row->product?->sku }}</span> <br>
                                            <span><span class="font-weight-bold">Description:</span> {{ $row->description }}</span> <br>
                                           
                                        @endif
                                    </td>

                                    {{--<td>
                                        {{ $row->product->price_rate }} X {{ $row->qty }} = {{ $row->product->price_rate * $row->qty }}
                                    </td>--}}
                                   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{--<div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <table class="table table-active">
                                    <thead>
                                        <tr>
                                            <th>Transaction</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $item)
                                        <tr>
                                            <td>{{ $item->transaction_id }}</td>
                                            <td>{{ $item->transaction_date }}</td>
                                            <td>{{ number_format($item->amount,2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right">Total Paid</td>
                                            <td>{{ number_format($order->orderDetails->sum('amount'),2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-lg-4" style="text-align: end !important">
                                @php
                                    $totalWindows = 0;
                                    $totalAccessories = 0;

                                    foreach ($order->OrderItems as $item) {
                                        // Check the order type
                                        if ($item->order_type === 'windows') {
                                            // Get the largest height value among height_left, height_middle, and height_right
                                            $largestHeight = max($item->height_left, $item->height_middle, $item->height_right);

                                            // Calculate the item cost for windows based on width and height
                                            if ($item->width > 280 && $largestHeight > 260) {
                                                $itemCost = (($item->width * $largestHeight) / 10000) * $item->product->price_rate + 
                                                            $item->product->base_charge + 
                                                            (($item->width * $largestHeight) / 10000) * $item->product->additional_charge;
                                            } else {
                                                $itemCost = (($item->width * $largestHeight) / 10000) * $item->product->price_rate + 
                                                            $item->product->base_charge;
                                            }
                                            
                                            // Multiply by quantity and add to totalWindows
                                            $totalWindows += $itemCost * $item->qty;

                                        } elseif ($item->order_type === 'accessories') {
                                            // Calculation for accessories
                                            $itemCost = $item->product->price_rate * $item->qty;
                                            $totalAccessories += $itemCost;
                                        }
                                    }

                                    // Final total combining windows and accessories
                                    $total = $totalWindows + $totalAccessories;
                                @endphp

                                <p>Items Subtotal: <span class="ml-5">AED {{ number_format($total, 2) }}</span>
                                </p>
                                <p>Items Total: <span class="ml-5">AED {{ number_format($order->order_total - (($order->coupon / 100) * $order->order_total) , 2) }}</span>
                                </p>

                                <p>Payment Method: <span class="ml-5">Pay Upfront</span></p>

                                <p>Pay Monthly: <span class="ml-5">AED 

                                {{ number_format(($order->order_total - (($order->coupon / 100) * $order->order_total)) / 3 , 2) }}

                               
                                </span></p>
                                @if($order->coupon)
                                    <p>User Coupon: <span class="ml-5">AED {{ $order->coupon }}%</span></p>
                                @endif
                                <p>Total Paid: <span class="ml-5">AED {{ number_format($order->orderDetails->sum('amount'),2) }}</span></p>


                                <p class="text-success">Due Amount: <span class="ml-5">AED 

                                @if($order->coupon)
                                    {{  number_format(($order->order_total - (($order->coupon / 100) * $order->order_total) - $order->orderDetails->sum('amount')),2) }}
                                @else
                                    {{  number_format(($order->order_total - $order->orderDetails->sum('amount')),2) }}
                                @endif

                            
                                </span></p>


                               
                               
                            </div>
                        </div>
                        
                       <!-- Barcode for order_code -->
                        <div class="mb-3">
                            <strong>Order Code Barcode: {{ $order->order_code }}</strong>
                            <div id="orderBarcode">
                                {!! DNS1D::getBarcodeHTML($order->order_code, 'C39') !!}
                            </div>
                            
                        </div>
                        <!-- Barcode for book_id -->
                        <!--<div class="mb-3">-->
                        <!--    <strong>Book ID Barcode:</strong>-->
                        <!--    <div id="bookBarcode">{!! DNS1D::getBarcodeHTML($order->book->book_id, 'C39') !!}</div>-->
                        <!--    <p>Book ID: {{ $order->book->book_id }}</p>-->
                        <!--</div>-->
                        
                    </div>--}}

                        <div class="card-footer itemsMain">
                            <div class="row d-flex justify-content-end">
                                <button onclick="window.print()" class="btn btn-success mr-2">Print</button>
                                <a href="{{ url()->previous() }} " class="btn btn-dark">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card -->
    </section>

    @section('script')
    @endsection
</x-admin-app-layout>