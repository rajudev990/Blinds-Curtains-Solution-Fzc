<x-app-layout>
    @section('title')
    {{ $pageTitle }} | Book A FREE VISIT
    @endsection

    @section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        #html-show {
            display: none;
        }
    </style>
    <style>
        .booking_times {
            display: none;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .booking_time {
            padding: 10px 20px;
            border: 1px solid #CCC;
            border-radius: 4px;
            cursor: pointer;
            background: #F9F9F9;
            display: inline-block;
            margin-bottom: 5px;
        }

        .booking_time.selected {
            border-color: #FF5722;
            background: #FFE0B2;

        }


        .book_structure_form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            row-gap: 20px;
            column-gap: 33px;
            max-width: 860px;
            margin: 0 auto;
            margin-bottom: 48px;
            box-shadow: 0px 2px 16px rgba(0, 0, 0, 0.08);
            padding: 48px;
        }

        .times_selector {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .times_selector div:hover {
            background: #eaeaea;
            box-shadow: 1px 0px #eee;
        }

        .times_selector div {
            display: flex;
            padding: 12px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 8px;
            border: 2px solid var(--beige-600, #F1E5D5) !important;
            background: var(--white, #FFF);
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.07);
            margin: 0 !important;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px;
        }

        .booking_time {
            margin-right: 5px;
        }

        .iti {
            display: block !important;
        }
    </style>
    @endsection
    @php
    $title = \App\Models\SectionTitle::first();
    @endphp
    <main class="main">

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $title->book_section_title }}</h2>
                <p>{{ $title->book_section_description }}</p>

            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 ">
                    <div class="col-lg-9 col-12 m-auto">

                        <form action="{{route('book.store')}}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                            @csrf
                            <div class="row gy-4">


                                <div class="col-md-12 m-0">
                                    <p class="city_discript mt-2">Please select the date and time date suitable to
                                        schedule your visit'</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <label for="email-field" class="pb-2">City *:</label>
                                            <select style="padding: 10px 15px;" name="city" id="city" class="form-select form-control  @error('city') is-invalid @enderror" required="">
                                                <option value="">Select City</option>
                                                <option value="Dubai">Dubai</option>
                                                <option value="Abu Dhabi">Abu Dhabi</option>
                                            </select>
                                            @error('city')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-2">

                                            <label for="email-field" class="pb-2">Date *:</label>
                                            <input type="text" autocomplete="off" id="datepicker" class="input-xlarge datepicker form-control  @error('booking_date') is-invalid @enderror" required="">
                                            @error('booking_date')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror

                                            @error('booking_time_id')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror

                                        </div>





                                        <!-- <div class="booking_times" id="booking_times">
                                        </div>

                                        <input type="hidden" name="booking_time_id" id="booking_time" required> -->
                                        <input type="hidden" name="booking_date" id="booking_date" required>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <label for="booking_time" class="pb-2">Please choose your Time *:</label>
                                    <select style="padding: 10px 15px;" name="booking_time_id" id="booking_time" class="form-select form-control" required>
                                        <option value="" disabled selected>Select a Schedule</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="first-name" class="pb-2">Full Name *:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="first-name" required="">
                                    @error('name')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="pb-2">Email *:</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required="">
                                    @error('email')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="pb-2">Phone *:</label>
                                    <!--<div class="d-flex">-->
                                    <!--<input type="text" readonly value="+971" name="phone_country" class="form-control w-50">-->
                                    <!--<select name="phone_code" id="phone_code" class="w-25" style="border: var(--bs-border-width) solid var(--bs-border-color);">-->
                                    <!--    <option value="50">50</option>-->
                                    <!--    <option value="52">52</option>-->
                                    <!--    <option value="54">54</option>-->
                                    <!--    <option value="56">56</option>-->
                                    <!--    <option value="58">58</option>-->
                                    <!--</select>-->
                                    <input style="border-radius:0px" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" required="">
                                    <div id="phone-error" class="text-danger" style="display:none;"></div>
                                    <!--</div>-->
                                    @error('phone')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="pb-2">Community / Building Name (optional):</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="flat_no">
                                    @error('address')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="pb-2">Falt No / Villa No. (optional):</label>
                                    <input type="text" class="form-control @error('flat_no') is-invalid @enderror" name="flat_no" id="flat_no">
                                    @error('flat_no')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="city1" class="pb-2">Select the number of windows (optional):</label>
                                    <select name="windows_number" class="form-select @error('windows_number') is-inv @enderror" aria-label="Default select example">
                                        <option value="1 window">1 window</option>
                                        <option value="2 window">2 window</option>
                                        <option value="3 windor or more">3 windor or more</option>
                                    </select>
                                    @error('windows_number')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="city1" class="pb-2">Blinds/Curtains Type (optional):</label>
                                    <select name="type" class="form-select @error('type') is-inv @enderror" aria-label="Default select example">
                                        <option value="Curtains">Curtains</option>
                                        <option value="Blinds">Blinds</option>
                                    </select>
                                    @error('type')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label onclick="showHtmlDiv()" for="message-field" class="pb-2" style="cursor: pointer;"><span style="font-weight: 700;color: #008000;">+ Add
                                            Comment:</span>(optional)</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" rows="5" id="html-show"></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit" style="background-color:#982f6a">Confirm the visit</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
    @section('script')

    <!--<script>
        $(document).ready(function() {
            let unavailableDates = [];

           
            $('#city').change(function() {
                const selectedCity = $(this).val(); 

                if (!selectedCity) {
                    alert('Please select a city.');
                    return;
                }

                
                $.ajax({
                    url: '/get-unavailable-dates', 
                    type: 'GET',
                    data: {
                        city: selectedCity
                    }, 
                    success: function(response) {
                        unavailableDates = response.map(date => new Date(date).toLocaleDateString());
                        $(".datepicker").datepicker("refresh"); 
                    },
                    error: function() {
                        alert('Unable to fetch unavailable dates.');
                    }
                });

             
                $('#booking_date').val('');
                $(".datepicker").datepicker("setDate", null);
                $("#booking_time").empty().append('<option value="" disabled selected>Select a time slot</option>');
            });

          
            function unavailable(date) {
                const dmy = date.toLocaleDateString(); 
                return unavailableDates.includes(dmy) ? [false, "", "Unavailable"] : [true, ""];
            }

           
            function isTimeSlotValidForToday(slot, currentTime) {
                const [startTime, endTime] = slot.split(" - ").map(time => {
                    
                    const timeParts = time.match(/(\d+):(\d+)\s?(am|pm)/i);
                    let hours = parseInt(timeParts[1], 10);
                    const minutes = parseInt(timeParts[2], 10);
                    const isPM = timeParts[3].toLowerCase() === 'pm';

                    
                    if (isPM && hours !== 12) hours += 12;
                    if (!isPM && hours === 12) hours = 0;

                    return hours * 60 + minutes; 
                });

                return startTime >= currentTime + 180; 
            }

            
            $(".datepicker").datepicker({
                dateFormat: "dd MM yy",
                beforeShowDay: unavailable,
                minDate: 0,
                maxDate: "+3M",
                onSelect: function(dateText) {
                    const selectedCity = $('#city').val();

                    if (!selectedCity) {
                        alert("Please select a city first.");
                        return;
                    }

                    $('#booking_date').val(dateText);

                    
                    $.ajax({
                        url: `/get-booking-time/${selectedCity}/${dateText}`,
                        type: 'GET',
                        success: function(response) {
                            const $timeDropdown = $("#booking_time");
                            $timeDropdown.empty().append('<option value="" disabled selected>Select a Schedule</option>');

                            const selectedDate = new Date(dateText);
                            const currentDate = new Date();

                            
                            if (selectedDate.toDateString() === currentDate.toDateString()) {
                                const currentTime =
                                    currentDate.getHours() * 60 + currentDate.getMinutes(); 
                                response = response.filter(slot => isTimeSlotValidForToday(slot.name, currentTime));
                            }

                            if (response.length === 0) {
                                $timeDropdown.append('<option value="" disabled>No available time slots</option>');
                            } else {
                                response.forEach(value => {
                                    $timeDropdown.append(`<option value="${value.id}">${value.name}</option>`);
                                });
                            }
                        },
                        error: function() {
                            alert('Failed to fetch time slots. Please try again.');
                        }
                    });
                }
            });

            
            $('#city').change(function() {
                $('#booking_date').val(''); 
                $(".datepicker").datepicker("setDate", null); 

                
                $("#booking_time").empty().append('<option value="" disabled selected>Select a time slot</option>');
            });
        });


        
        function timeSelect(id) {
            $(".booking_time").removeClass("selected");
            $(`#booking_time_${id}`).addClass("selected");
            $('#booking_time').val(id);
        }
    </script>-->


<!--new code-->
<script>
        $(document).ready(function() {
            let unavailableDates = [];

            // Fetch unavailable dates when the city changes
            $('#city').change(function() {
                const selectedCity = $(this).val();

                if (!selectedCity) {
                    alert('Please select a city.');
                    return;
                }

                // Fetch unavailable dates for the selected city
                $.ajax({
                    url: '/get-unavailable-dates',
                    type: 'GET',
                    data: {
                        city: selectedCity
                    },
                    success: function(response) {
                        unavailableDates = response.map(date => new Date(date).toLocaleDateString());
                        $(".datepicker").datepicker("refresh");
                    },
                    error: function() {
                        alert('Unable to fetch unavailable dates.');
                    }
                });

                // Reset fields
                $('#booking_date').val('');
                $(".datepicker").datepicker("setDate", null);
                $("#booking_time").empty().append('<option value="" disabled selected>Select a time slot</option>');
            });

            // Disable unavailable dates in datepicker
            function unavailable(date) {
                const dmy = date.toLocaleDateString();
                return unavailableDates.includes(dmy) ? [false, "", "Unavailable"] : [true, ""];
            }

            // Function to filter time slots based on current time for today's date
            function filterAvailableTimeSlots(slots, bookedSlots) {
                const now = new Date();
                const currentMinutes = now.getHours() * 60 + now.getMinutes(); // Convert current time to minutes
                let nextAvailableMinutes = currentMinutes + 60; // Show only times 1 hour after now

                return slots.filter(slot => {
                    let timeParts = slot.name.match(/(\d+):(\d+)\s?(AM|PM)/i); // Extract time format
                    if (!timeParts) return false;

                    let hour = parseInt(timeParts[1], 10);
                    let minute = parseInt(timeParts[2], 10);
                    let isPM = /PM/i.test(timeParts[3]);

                    // Convert to 24-hour format
                    if (isPM && hour !== 12) hour += 12;
                    if (!isPM && hour === 12) hour = 0;

                    let slotMinutes = hour * 60 + minute; // Convert slot to minutes

                    // Skip booked time slots and only show available ones after that
                    if (slotMinutes < nextAvailableMinutes || bookedSlots.includes(slot.name)) {
                        return false;
                    }

                    return true;
                });
            }

            // Initialize datepicker
            $(".datepicker").datepicker({
                dateFormat: "dd MM yy",
                beforeShowDay: unavailable,
                minDate: 0,
                maxDate: "+3M",
                onSelect: function(dateText) {
                    const selectedCity = $('#city').val();
                    if (!selectedCity) {
                        alert("Please select a city first.");
                        return;
                    }

                    $('#booking_date').val(dateText);

                    // Fetch available and booked time slots
                    $.ajax({
                        url: `/get-booking-time/${selectedCity}/${dateText}`,
                        type: 'GET',
                        success: function(response) {
                            const $timeDropdown = $("#booking_time");
                            $timeDropdown.empty().append('<option value="" disabled selected>Select a Schedule</option>');

                            const selectedDate = new Date(dateText);
                            const currentDate = new Date();
                            let availableSlots = response.available;
                            let bookedSlots = response.booked; // Assume backend returns both available & booked slots

                            if (selectedDate.toDateString() === currentDate.toDateString()) {
                                availableSlots = filterAvailableTimeSlots(availableSlots, bookedSlots);
                            }

                            if (availableSlots.length === 0) {
                                $timeDropdown.append('<option value="" disabled>No available time slots</option>');
                            } else {
                                availableSlots.forEach(value => {
                                    $timeDropdown.append(`<option value="${value.id}">${value.name}</option>`);
                                });
                            }
                        },
                        error: function() {
                            alert('Failed to fetch time slots. Please try again.');
                        }
                    });
                }
            });

            // Clear fields when the city changes
            $('#city').change(function() {
                $('#booking_date').val('');
                $(".datepicker").datepicker("setDate", null);
                $("#booking_time").empty().append('<option value="" disabled selected>Select a time slot</option>');
            });
        });
    </script>
<!--new code end-->


    <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "ae", // UAE as the default country
            separateDialCode: true, // To store country code separately
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Function to validate the phone number
        function validatePhone() {
            var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164); // Get the full number
            if (!iti.isValidNumber()) {
                $('#phone').addClass('is-invalid'); // Add invalid class
                $('#phone-error').text('Please enter a valid phone number').show(); // Show error message
            } else {
                $('#phone').removeClass('is-invalid'); // Remove invalid class if valid
                $('#phone-error').hide(); // Hide the error message
            }
        }

        // Validate the phone number when the input field changes
        input.addEventListener('change', validatePhone);
        input.addEventListener('keyup', validatePhone); // Validate on keyup as well for immediate feedback

        // Validate the phone number before submitting the form
        $('form').submit(function(e) {
            var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164); // Get the full number in E.164 format

            if (!iti.isValidNumber()) {
                e.preventDefault(); // Prevent form submission
                $('#phone').addClass('is-invalid'); // Add invalid class
                $('#phone-error').text('Please enter a valid phone number').show(); // Show error message
                return false;
            }

            $('#phone').val(fullNumber); // Set the formatted number in the input if valid
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the form by its class
            const form = document.querySelector('.php-email-form');

            if (form) {
                form.addEventListener('submit', function(e) {
                    // Prevent default form submission temporarily for testing
                    // e.preventDefault();

                    // Get form values
                    const name = document.querySelector('[name="name"]').value;
                    const phone = document.querySelector('[name="phone"]').value;
                    const email = document.querySelector('[name="email"]').value;
                    const bookDate = document.querySelector('[name="booking_date"]').value;
                    const bookTime = document.querySelector('[name="booking_time_id"]').value;
                    const building = document.querySelector('[name="address"]').value;
                    const flatNo = document.querySelector('[name="flat_no"]').value;
                    const windowsNumber = document.querySelector('[name="windows_number"]').value;
                    const windowsType = document.querySelector('[name="type"]').value;

                    // Push the data to the dataLayer
                    window.dataLayer = window.dataLayer || [];
                    window.dataLayer.push({
                        event: "book",
                        bookstore: {
                            customerFullName: name,
                            customerEmail: email,
                            customerPhoneNumber: phone,
                            bookDate: bookDate,
                            bookTime: bookTime,
                            CommunityBuildingName: building,
                            flatNo: flatNo,
                            windowsNumber: windowsNumber,
                            windowsType: windowsType,
                        },
                    });


                    // Log for debugging
                    console.log('DataLayer Push Successful:', {
                        event: "book",
                        bookstore: {
                            customerFullName: name,
                            customerEmail: email,
                            customerPhoneNumber: phone,
                            bookDate: bookDate,
                            bookTime: bookTime,
                            CommunityBuildingName: building,
                            flatNo: flatNo,
                            windowsNumber: windowsNumber,
                            windowsType: windowsType,
                        },
                    });

                    // Optionally, you can re-enable form submission after testing
                    // Uncomment this line to submit the form:
                    // form.submit();
                });
            } else {
                console.error('Form not found. Check the selector.');
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let lastScrollPosition = window.scrollY;

            window.addEventListener('scroll', function() {
                const currentScrollPosition = window.scrollY;

                // Check if the user is scrolling up
                if (currentScrollPosition < lastScrollPosition) {
                    // Push the data to the dataLayer
                    window.dataLayer = window.dataLayer || [];
                    window.dataLayer.push({
                        event: "scrollUp",
                        interaction: {
                            action: "User scrolled up",
                            scrollPosition: currentScrollPosition,
                        },
                    });

                    console.log('ScrollUp event pushed to dataLayer:', currentScrollPosition);
                }

                // Update lastScrollPosition to current position
                lastScrollPosition = currentScrollPosition;
            });
        });
    </script>



    @endsection
</x-app-layout>