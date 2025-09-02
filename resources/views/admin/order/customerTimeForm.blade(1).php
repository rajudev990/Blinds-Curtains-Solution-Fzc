@php
$setting = \App\Models\Setting::first();
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/'.$setting->favicon) }}">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <title>Installation Shedule Setup | Blinds & Curtains Solution Fzc</title>

    <style>
        .summary {
            /* box-shadow: 0px 1px 16px rgba(0, 0, 0, 0.08); */
            border-radius: 8px;
            background-color: white;
            padding: 30px;
            border: 1px solid #ffc107;
        }

        .payment-btn {
            background-color: #E2783C;
            width: 100%;
            color: white;
            padding: 12px;
            text-transform: uppercase;
            border: unset;
            border-radius: 8px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .whatsapp-btn {
            background-color: white;
            width: 100%;
            color: #000;
            /* padding: 12px; */
            text-align: center;
            text-transform: uppercase;
            border: 1px solid #E2783C;
            border-radius: 8px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .navbar {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        .design {
            margin-left: 21rem;
        }

        .fixed-right {
            margin-right: -256px;
        }

        @media(max-width:426px) {
            .navbar {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .design {
                margin-left: 3rem;
            }

            .fixed-right {
                margin-right: -10px;
            }

            .price {
                margin-left: 0px !important;
            }

        }
        .accordion-button::after{
            margin-left: 5px !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-white shadow">
        <div class="d-flex align-items-center">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <img src="/storage/uploads/a6cb46e2-c650-48d8-bcf1-06588108abcc.png"
                    alt="Blinds &amp; Curtains Solution Fzc" style="max-width: 134px;">
            </a>
        </div>
        <div>
            <p class="mb-0 fs-5">Order <b>#{{ $data->order_code }}</b></p>
        </div>
    </nav>

    <section class="content-header">
        <div class="container pt-3 mt-5">
            <div class="row mb-2">
                <div class="col-lg-10 d-flex" style="justify-content: flex-start;align-items: flex-end;">
                    <h1>Installation Shedule Setup</h1>
                    <ol class="breadcrumb float-sm-right" style="margin-left: 40px;">
                        <li class="breadcrumb-item active">Choose Your Time</li>
                        <li class="breadcrumb-item ">For Installation</li>
                    </ol>
                </div>
                <div class="col-lg-2">
                    <a href="{{ url('/') }}" type="button" class="btn btn-outline-light"
                        style="background-color: #E2783C;padding: 13px 34px 12px 33px;font-weight: 700;">CANCEL</a>
                </div>

                @if ($settings->time_shedule)
                <div class="col-12 mb-3">
                    <b class="text-success">
                        {!! $settings->time_shedule !!}
                    </b>
                </div>
                @endif


            </div>
        </div>
    </section>

    <div class="container pt-3 mt-5">
        <div class="row">
             <div class="col-lg-7 mb-3">

                <div class="accordion accordion-flush" id="accordionExample">

                    @foreach ($data->OrderItems as $item)
                    @if ($item->order_type == 'windows')

                    <div class="accordion-item mb-4 shadow-sm">
                        
                        <h2 class="accordion-header" id="headingOne">
                            <button
                                class="border accordion-button collapsed bg-transparent fw-bold d-flex align-items-center justify-content-between"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne-{{ $item->id }}" aria-expanded="true"
                                aria-controls="collapseOne" style="font-size: 19px;">
                                
                                @if ($data->payment_status == 'half')
                                <input type="checkbox" style="width: 18px;height: 18px;" {{ $item->status==1 ? 'checked' : ''}} readonly="" disabled="">
                                @elseif ($data->payment_status == 'full')
                                <input type="checkbox" style="width: 18px;height: 18px;" {{ $item->status==1 ? 'checked' : ''}} readonly="" disabled="">
                                @elseif ($data->payment_status == null)
                                <input type="checkbox" id="orderstatus_{{ $item->id}}" data-id="{{ $item->id }}" class="order-status"  {{ $item->status==1 ? 'checked' : ''}} style="width: 18px;height: 18px;">
                                @endif
                                
                                
                                <p class="mb-0" style="font-size: 18px; font-weight: bold;margin-left:5px">{{ $item->window_name ?? 'No Name' }}</p>
                                <div class="mb-0 ms-auto" style="font-size: 18px; font-weight: bold;margin-right:8px">

                                   @php
                                    // Calculate the maximum height
                                    $height = max(
                                        floatval($item->height_left ?? 0),
                                        floatval($item->height_middle ?? 0),
                                        floatval($item->height_right ?? 0)
                                    );
                                
                                    $windowTotal = 0; // Total for the main window
                                
                                    // Calculate the window total
                                    $width = floatval($item->width ?? 0);
                                    $area = ($width * $height) / 10000; // Convert to square meters
                                    $priceRate = floatval($item->product->price_rate ?? 0);
                                    $baseCharge = floatval($item->product->base_charge ?? 0);
                                    $additionalCharge = floatval($item->product->additional_charge ?? 0);
                                
                                    if ($width > 280 && $height > 260) {
                                        $windowTotal = $area * $priceRate + $baseCharge + $area * $additionalCharge;
                                    } else {
                                        $windowTotal = $area * $priceRate + $baseCharge;
                                    }
                                
                                    // Calculate related items total
                                    $relatedItemsTotal = 0;
                                    $relatedRows = $data->OrderItems->filter(function ($relatedItem) use ($item) {
                                        return $relatedItem->window_id == $item->id; // Match window_id with the current item's ID
                                    });
                                
                                    foreach ($relatedRows as $relatedRow) {
                                        $relatedPriceRate = floatval($relatedRow->product->price_rate ?? 0);
                                        $relatedBaseCharge = floatval($relatedRow->product->base_charge ?? 0);
                                        $relatedWidth = floatval($relatedRow->width ?? 0);
                                
                                        if ($relatedRow->product->cm_length == 'per piece') {
                                            $relatedItemsTotal += ($relatedPriceRate + $relatedBaseCharge) * $relatedRow->qty;
                                        } elseif ($relatedRow->product->cm_length == 'per line meter') {
                                            $relatedItemsTotal += ($relatedWidth / 100) * ($relatedPriceRate + $relatedBaseCharge) * $relatedRow->qty;
                                        }
                                    }
                                
                                    // Calculate final total
                                    $finalTotal = ($windowTotal * $item->qty) + $relatedItemsTotal;
                                @endphp
                                
                                <spa class="accordion-price">AED {{ number_format($finalTotal, 2) }}</spa>



                                    
                                </div>
                            </button>

                        </h2>

                        <div id="collapseOne-{{ $item->id }}" class="accordion-collapse collapse shadow {{ $loop->first ? 'show' : '' }}"
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="d-flex justify-content-between"
                                style="background-color: #FAF7F1; padding:padding: 1rem 1.25rem; ">
                                <div class="accordion-body d-flex align-items-stretch ">
                                    @if ($item->product?->image !== null)
                                    <img style="width: 104px; border-radius: 8px;margin-right: 13px;"
                                        src="{{ Storage::url($item->product->image) }}" alt="">
                                    @endif
                                    <div>
                                        <strong>
                                            {{ $item->product->title }}</strong>
                                        <p>Height:
                                            {{ max($item->height_left, $item->height_middle, $item->height_right) }}
                                            / Width: {{ $item->width }}
                                        </p>
                                    </div>

                                </div>
                                <div class="mt-4">
                                    <p class="mb-0 fs-6 price" style="font-size: 18px; font-weight: bold;">
                                        AED

                                        @if($item->order_type == 'windows')
                                        @php
                                            // Calculate the maximum height
                                            $height = max(
                                                floatval($item->height_left ?? 0),
                                                floatval($item->height_middle ?? 0),
                                                floatval($item->height_right ?? 0)
                                            );
                                    
                                            $windowTotal = 0; // Total for the main window
                                    
                                            // Ensure numeric values for calculations
                                            $width = floatval($item->width ?? 0);
                                            $priceRate = floatval($item->product->price_rate ?? 0);
                                            $baseCharge = floatval($item->product->base_charge ?? 0);
                                            $additionalCharge = floatval($item->product->additional_charge ?? 0);
                                    
                                            // Calculate the window total
                                            $area = ($width * $height) / 10000; // Convert to square meters
                                    
                                            if ($width > 280 && $height > 260) {
                                                $windowTotal = $area * $priceRate + $baseCharge + $area * $additionalCharge;
                                            } else {
                                                $windowTotal = $area * $priceRate + $baseCharge;
                                            }
                                        @endphp
                                    
                                        {{ number_format($windowTotal * floatval($item->qty), 2) }}
                                    @endif

                                    </p>
                                </div>
                                <hr class="m-0">
                            </div>

                           

                            <div class="mt-4">
                                @php
                                    $relatedRows = $data->OrderItems->filter(function ($relatedItem) use ($item) {
                                        return $relatedItem->window_id == $item->id; // Match window_id with the current item's ID
                                    });
                                @endphp
                                @if ($relatedRows->isNotEmpty())
                                <h5 style="font-size: 18px; margin-left: 1.25rem;">Additional items</h5>
                                <hr class="m-0">
                                @foreach ($relatedRows as $relatedRow)
                                <div class="d-flex justify-content-between"
                                    style="padding: 1rem 1.25rem;">
                                    <div>
                                        
                                        
                                         @if ($data->payment_status == 'half')
                                        <input type="checkbox" style="width:16px;height:16px;" {{ $relatedRow->status==1 ? 'checked' : ''}} readonly="" disabled="">
                                    {{ $relatedRow->qty }} X {{ $relatedRow->product?->title }}
                                        @elseif ($data->payment_status == 'full')
                                        <input type="checkbox" style="width:16px;height:16px;" {{ $relatedRow->status==1 ? 'checked' : ''}} readonly="" disabled="">
                                    {{ $relatedRow->qty }} X {{ $relatedRow->product?->title }}
                                        @elseif ($data->payment_status == null)
                                        <input type="checkbox" id="orderstatus_{{ $relatedRow->id}}" data-id="{{ $relatedRow->id }}" class="order-status"  {{ $relatedRow->status==1 ? 'checked' : ''}} style="width:16px;height:16px;">
                                    {{ $relatedRow->qty }} X {{ $relatedRow->product?->title }}
                                        @endif
                                        
                                        
                                        
                                    <br>

                                    </div>
                                    <div style="font-size: 18px; font-weight: bold;">
                                        @if ($relatedRow->product->cm_length == 'per piece')
                                        AED
                                        {{ number_format(($relatedRow->product->price_rate + $relatedRow->product->base_charge) * $relatedRow->qty,2) }}
                                        @elseif($relatedRow->product->cm_length == 'per line meter')
                                        AED
                                        {{ number_format(($relatedRow->width / 100) * ($relatedRow->product->price_rate + $relatedRow->product->base_charge) * $relatedRow->qty,2) }}
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endif

                            </div>



                            {{-- <div class="mt-4">
                                        <h5 style="font-size: 18px; margin-left: 1.25rem;">Fabrics</h5>
                                        <hr class="m-0">
                                        <div class="d-flex justify-content-around" style="padding: 1rem 1.25rem;">
                                            <div>
                                                <img class="rounded-circle" alt="100x100"
                                                    src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg"
                                                    data-holder-rendered="true" style="width: 66px;">
                                                <strong>Sheer Premium</strong>

                                            </div>
                                            <div>
                                                <img class="rounded-circle" alt="100x100"
                                                    src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg"
                                                    data-holder-rendered="true" style="width: 66px;">
                                                <strong>Sheer Premium</strong>
                                            </div>
                                        </div>
                                    </div> --}}
                            <div class="mt-4">
                                <h5 style="font-size: 18px; margin-left: 1.25rem;">Additional
                                    information</h5>
                                <hr class="m-0">
                                <div class="d-flex justify-content-between" style="padding: 1rem 1.25rem;">
                                    <div>
                                        <span><span class="fw-bold">Comment:</span>
                                            {{ $item->comment }}</span>
                                        <br>
                                        <span><span class="fw-bold">Fullness:</span>
                                            {{ $item->fullness }}</span>
                                        <br>
                                        <span><span class="fw-bold">Pooling:</span>
                                            {{ $item->polling }}</span>
                                        <br>
                                        <span><span class="fw-bold">Openning:</span>
                                            {{ $item->opening }}</span>
                                        <br>
                                        <span><span class="fw-bold">Lining:</span>
                                            {{ $item->lining }}</span>
                                        <br>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>

                {{-- 2nd accordian for accessories --}}
                @foreach ($data->OrderItems as $item)
                @if ($item->order_type == 'accessories' && is_null($item->window_id))
                <div class="accordion-item mb-4 shadow-sm">
                    <h2 class="accordion-header" id="headingOne">
                        <button
                            class="border accordion-button collapsed bg-transparent fw-bold d-flex align-items-center justify-content-between"
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne-{{ $item->id }}" aria-expanded="true"
                            aria-controls="collapseOne" style="font-size: 19px;">
                            
                             @if ($data->payment_status == 'half')
                                 <input type="checkbox" style="width: 18px;height: 18px;" {{ $item->status==1 ? 'checked' : ''}} readonly="" disabled="">
                                @elseif ($data->payment_status == 'full')
                                 <input type="checkbox" style="width: 18px;height: 18px;" {{ $item->status==1 ? 'checked' : ''}} readonly="" disabled="">
                                @elseif ($data->payment_status == null)
                                 <input type="checkbox" id="orderstatus_{{ $item->id}}" data-id="{{ $item->id }}" class="order-status"  {{ $item->status==1 ? 'checked' : ''}} style="width: 18px;height: 18px;">
                                @endif
                                
                            
                            
                           
                            <p class="mb-0" style="font-size: 18px; font-weight: bold;margin-left:5px;"> {{ $item->product->title ?? 'No Name' }}</p>
                            <div class="mb-0 ms-auto" style="font-size: 18px; font-weight: bold;margin-right:8px;">

                               
                                @if ($item->product->cm_length == 'per piece')
                                
                                <span class="accordion-price">AED {{ number_format(($item->product->price_rate + $item->product->base_charge) * $item->qty,2) }}</span>
                                @elseif($item->product->cm_length == 'per line meter')
                                
                                <span class="accordion-price">AED {{ number_format(($item->width / 100) * ($item->product->price_rate + $item->product->base_charge) * $item->qty,2) }}</span>
                                @endif
                     
                            </div>
                        </button>

                    </h2>

                    <div id="collapseOne-{{ $item->id }}" class="accordion-collapse collapse  shadow"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="d-flex justify-content-between"
                            style="background-color: #FAF7F1; padding:padding: 1rem 1.25rem; ">
                            <div class="accordion-body d-flex align-items-stretch ">
                                @if ($item->product?->image !== null)
                                <img style="width: 104px; border-radius: 8px;margin-right: 13px;"
                                    src="{{ Storage::url($item->product->image) }}" alt="">
                                @endif
                                <div>
                                    <strong>
                                        {{ $item->product->title }}</strong>
                                    <p>Height:
                                        {{ $item->height }}
                                        / Width: {{ $item->width }}
                                    </p>
                                </div>

                            </div>
                            <div class="mt-4">
                                <p class="mb-0 fs-6 price" style="font-size: 18px; font-weight: bold;">
                                @if ($item->product->cm_length == 'per piece')
                                AED
                                {{ number_format(($item->product->price_rate + $item->product->base_charge) * $item->qty,2) }}
                                @elseif($item->product->cm_length == 'per line meter')
                                AED
                                {{ number_format(($item->width / 100) * ($item->product->price_rate + $item->product->base_charge) * $item->qty,2) }}
                                @endif
                                
                                </p>
                            </div>
                            <hr class="m-0">
                        </div>

                    </div>
                </div>
                @endif
                @endforeach
    </div>




            <div class="col-lg-5 mb-3">
                <div class="card summary">
                    <h4 class="pb-3">Installation</h4>
                    <p class="d-flex justify-content-between mb-0">
                        <span>Sub Total</span>
                        <span style="font-weight:bold;">AED {{ $data->order_subtotal }}</span>
                    </p>
                    <p class="d-flex justify-content-between mb-0">
                        <span>Delivery</span>
                        <span style="font-weight:bold;">FREE</span>
                    </p>
            
                    <hr class="m-0">
            
                    @php
                        // Convert order total safely
                        $ordertotal = $data->order_total ? (float) preg_replace('/[^0-9.]/', '', $data->order_total) : 0.00;
                        $paid = $data->orderDetails->sum('amount') ? (float) $data->orderDetails->sum('amount') : 0.00;
                    
                        // Initialize total and discount amount
                        $total = $ordertotal;
                        $discountAmount = 0;
                        
                    
                        // Check for session coupon discount
                        if (session('coupon_discount')) {
                            $discountPercent = (float) session('coupon_discount');
                            $discountAmount = ($total * $discountPercent) / 100;
                        }
                        
                        if($data->coupon){
                            $discountPercent = (float) $data->coupon;
                            $discountAmount = ($total * $discountPercent) / 100;
                        }
                    
                        // Apply discount
                        $total = $total - $discountAmount;
                        
                    
                        // Debugging final value
                      
                    @endphp
        
            
                    {{--<p class="d-flex justify-content-between mb-0">
                        <span>Price After {{ $data->order_coupon ? $data->order_coupon . '%' : '' }} Discount</span>
                        <span style="font-weight:bold;">AED {{ number_format($discountAmount, 2) }}</span>
                    </p>--}}
                    
                    <p class="d-flex justify-content-between mb-0">
                        <span>Discount :</span>
                        <span style="font-weight:bold;">{{ $data->order_coupon ? number_format($data->order_coupon,2) . '%' : '0.00 %' }}</span>
                    </p>
                    
                    @if (session('coupon_discount'))
                    <p class="d-flex justify-content-between mb-0">
                        <span>Coupon :</span>
                        <span style="font-weight:bold;">{{ number_format($discountPercent, 2) }}%</span>
                    </p>
                    @endif
                    
                    @if ($data->coupon)
                    <p class="d-flex justify-content-between mb-0">
                        <span>Coupon :</span>
                        <span style="font-weight:bold;">{{ number_format($data->coupon, 2) }}%</span>
                    </p>
                    @endif
            
                    {{--@if (session('coupon_discount'))
                        <p class="d-flex justify-content-between mb-0">
                            <span>Coupon {{ number_format($discountPercent, 2) }}% Discount Applied</span>
                            <span style="font-weight:bold;">AED {{ number_format($discountedTotal, 2) }}</span>
                        </p>
                    @endif--}}
                    
                    <p class="d-flex justify-content-between mb-0">
                        <span>Vat :</span>
                        <span style="font-weight:bold;">AED 5.00 %</span>
                    </p>
                    
                    <p class="d-flex justify-content-between mb-0">
                        <span>Total Amount :</span>
                        <span style="font-weight:bold;">AED {{ number_format($total, 2) }}</span>
                    </p>
                    
                    @if ($data->payment_status == 'half')
                    <p class="d-flex justify-content-between mb-0 text-danger">
                        <span>Due Amount :</span>
                        <span style="font-weight:bold;">AED {{ number_format($total - $paid, 2) }}</span>
                    </p>
                    @elseif ($data->payment_status == 'full')
                    @elseif (is_null($data->payment_status))
                    <p class="d-flex justify-content-between mb-0 text-danger">
                        <span>Due Amount :</span>
                        <span style="font-weight:bold;">AED {{ number_format($total - $paid, 2) }}</span>
                    </p>
                    @endif
            
                    <p class="mb-0">0% interest rate</p>
            
                    <a id="whatsapp-link" class="whatsapp-btn mt-2" style="text-decoration: none;" target="_blank">
                        <img src="{{ asset('frontend/assets/img/whatsapp.png') }}" alt="img-fluid" width="50px">
                        <span>Talk To Someone</span>
                    </a>

                    <form action="{{ route('order.send-install-time', $data->order_code) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="installDate" class="form-label">Install Date</label>
                            <input id="installDate" type="date" class="form-control" name="install_date">
                            <small id="dateError" style="color: red; display: none;">Sundays are not allowed!</small>
                        </div>

                        <input type="hidden" name="order_code" id="order_code" value="{{ $data->order_code }}">
                        <input type="hidden" name="install_time" id="selectedTimeSlot">
                        <div id="booking_times" class="mt-3"></div>



                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Note</label>
                            <input type="text" class="form-control" name="install_note">
                        </div>

                        <button type="submit" class="payment-btn">Submit</button>


                    </form>


                    @if ($data->coupon)
                    @else
                    <form action="{{ route('applyCoupon') }}" class="mt-3" method="post">
                        @csrf
                        <div class="form-group d-flex">
                            <input placeholder="Have coupon code" type="text" name="coupon"
                                class="form-control border-none" style="border-radius:0px !important;" required>
                            <button type="submit" class="btn btn-sm"
                                style="background-color: #982f6a;color:white;border-radius:0px !important;">Apply</button>
                        </div>
                    </form>
                    @endif

                </div>
            </div>



        </div>

    </div>


    <script src="{{ asset('admin/') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('frontend/assets/css/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        toastr.error('{{ $error }}')
    </script>
    @endforeach
    @endif

    <script>
        $(document).ready(function() {
            const phoneNumber = "971561278800"; // Replace with your phone number
            const message = "Hello B & C,";
            const encodedMessage = encodeURIComponent(message);

            const whatsappLink = https: //api.whatsapp.com/send?phone=${phoneNumber}&text=${encodedMessage};

                $("#whatsapp-link").attr("href", whatsappLink);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#installDate').on('change', function() {
                var selectedDate = new Date($(this).val());
                var orderCode = $('#order_code').val();

                if (selectedDate.getDay() === 0) {
                    $('#dateError').show();
                    $('#booking_times').html('');
                } else {
                    $('#dateError').hide();


                    $.ajax({
                        url: '{{ route('order.get-install-times') }}',
                        type: 'GET',
                        data: {
                            date: $(this).val(),
                            order_code: orderCode
                        },
                        success: function(response) {
                            $('#booking_times').html(response.html);
                        },
                        error: function(xhr) {
                            alert('An error occurred while fetching time slots.');
                        }
                    });
                }
            });


            $(document).on('click', '.time-slot-btn', function() {
                var selectedTime = $(this).data('time');
                $('#selectedTimeSlot').val(selectedTime);
                $('.time-slot-btn').removeClass('btn-success').addClass('btn-outline-primary');
                $(this).removeClass('btn-outline-primary').addClass('btn-success');
            });
        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000"
        }
    </script>

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    @if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif



</body>

</html>