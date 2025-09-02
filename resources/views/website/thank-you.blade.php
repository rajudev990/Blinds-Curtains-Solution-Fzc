<x-app-layout>
    @php
    $title = \App\Models\SectionTitle::first();
    @endphp

    @section('title')
    {{ $pageTitle }} | Thank You
    @endsection

    <style>
        .thank-you-icon {
            text-align: center;
            font-size: 80px;
            color: #28a745;
            /* Green color */
        }

        /* Animated border effect */
        .card {
            border: 2px solid #982f6a !important;
            border-radius: 10px;
        }
    </style>


    <!-- Thank You Section -->
    <div class="container py-4">
        <div class="d-flex justify-content-center row">
            <div class="col-md-7 col-lg-7 col-12">
                <div class="card border-0 shadow-lg p-4">
                    <div class="card-body text-center">
                        <div class="thank-you-icon mb-3">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h1 class="display-5">Thank You!</h1>
                        <p class="lead mt-3 mb-1">Your submission has been received successfully.</p>

                        @if($offerCode)
                        <p class="mb-1">Your offer code is: <strong>{{ $offerCode }}</strong></p>
                        <p class="mb-1">Use this code to get your discount.</p>
                        @else
                        <p class="mb-1">We appreciate your interest. No offer code was generated.</p>
                        @endif

                        <a href="/" class="btn btn-lg mt-4" style="background:#982f6a;color:white;">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @section('script')
    <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Get data from the session
                const name = @json(session('name'));
                const email = @json(session('email'));
                const phone = @json(session('phone'));
                const offerCode = @json(session('offer_code'));

                // Push data to the dataLayer
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: "subscriberAdded",
                    subscriberInfo: {
                        name: name,
                        email: email,
                        phone: phone,
                        code: offerCode,
                    },
                });

                console.log('DataLayer Push:', {
                    event: "subscriberAdded",
                    subscriberInfo: {
                        name: name,
                        email: email,
                        phone: phone,
                        code: offerCode,
                    },
                });
            });
        </script>

    @endsection

</x-app-layout>