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
                    <h3>Installation Shedule Setup</h3>
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
            
            <div class="col-lg-5 mb-3 m-auto">
                <div class="card summary">
                    <h4 class="pb-3">Installation</h4>
                   
            
                    
            
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