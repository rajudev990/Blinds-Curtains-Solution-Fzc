<x-app-layout>
    @section('title')
    {{ $pageTitle }} | Thank You For Booking
    @endsection

    <style>
        .thank-you-icon {
    
        }

        /* Animated border effect */
        .card {
            border: 2px solid #982f6a !important;
            border-radius: 10px;
        }
        .list-group-item{
            border: 1px dashed;
            text-align:left;
        }
    </style>


    <!-- Thank You Section -->
    <div class="container py-4">
        <div class="d-flex justify-content-center row">
            <div class="col-md-7 col-lg-7 col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center pt-0">
                        <div class="thank-you-icon">
                            <!--<i class="bi bi-check-circle-fill"></i>-->
                            <img src="{{ asset('frontend/thankyou.png') }}" class="img-fluid" style="width:200px;">
                        </div>
                        <!--<h1 class="display-5">Thank You!</h1>-->
                        <p class="lead mt-3 mb-1 fw-bold" style="color:green !important;">“Thank you for scheduling your appointment!</p>
                        <p>It has been successfully confirmed, and our team will reach out to you one hour before their arrival. We look forward to assisting you!”</p>
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>City:</strong> {{ $bookingData->city }}</li>
                            <li class="list-group-item"><strong>Booking ID:</strong> {{ $bookingData->book_id }}</li>
                            <li class="list-group-item"><strong>Booking Date:</strong> {{ $bookingData->booking_date->format('d-m-Y') }}</li>
                            <li class="list-group-item"><strong>Booking Time:</strong> {{ $bookingData->bookingTime->name ?? 'N/A' }}</li>
                            <li class="list-group-item"><strong>Name:</strong> {{ $bookingData->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $bookingData->email }}</li>
                            <li class="list-group-item"><strong>Phone:</strong> {{ $bookingData->phone }}</li>
                            <li class="list-group-item"><strong>Address:</strong> {{ $bookingData->address }}</li>
                            <li class="list-group-item"><strong>Flat No:</strong> {{ $bookingData->flat_no }}</li>
                            <li class="list-group-item"><strong>Windows Number:</strong> {{ $bookingData->windows_number }}</li>
                            <li class="list-group-item"><strong>Blinds/Curtains Type:</strong> {{ $bookingData->type }}</li>
                        </ul>

                        

                        <a href="{{ route('home') }}" class="btn btn-lg mt-4" style="background:#982f6a;color:white;">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @section('script')

    @endsection

</x-app-layout>