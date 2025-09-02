<x-admin-app-layout>
    @section('title') Dashboard @endsection
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

        @canany(['Dashboard access'])
            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::count(); }}</h3>
                            <p>Total Books</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.books.index') }}" class="small-box-footer">Booking List <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ \App\Models\ContactUs::count(); }}</h3>
                            <p>Contact Message</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('admin.contacts.index') }}" class="small-box-footer">Contact List <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ \App\Models\Product::count() }}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.product.index') }}" class="small-box-footer">Product Lists <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ \App\Models\Category::count() }}</h3>
                            <p>Total Categories</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('admin.categories.index') }}" class="small-box-footer">Product Categories <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::count() }}</h3>
                            <p>Total Booking</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('admin.books.index') }}" class="small-box-footer">Bookking List <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::where('status','pending')->count() }}</h3>
                            <p>Booking Pending</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.books.index') }}" class="small-box-footer">Pending List <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::where('status','cancel')->count() }}</h3>
                            <p>Booking Faild</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.books.index') }}" class="small-box-footer">Faild List <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::where('status','block')->count() }}</h3>
                            <p>Booking Block</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('admin.books.index') }}" class="small-box-footer">Booking Block <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::where('status','completed')->count() }}</h3>
                            <p>Booking Complete</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('admin.order.complete-list') }}" class="small-box-footer">Booking Complete <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ \App\Models\Book::where('status','cancel')->count() }}</h3>
                            <p>Booking Trash</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.order.cancel-list') }}" class="small-box-footer">Booking Trash <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        @endcanany



            <div class="row">
            @canany(['Calendar One'])
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Dubai</div>
                        </div>
                        <div class="card-body p-0">
                            <div id="book_calender"></div>
                        </div>
                    </div>
                </div>
                @endcanany
                @canany(['Calendar Two'])
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Abu Dhabi</div>
                        </div>
                        <div class="card-body p-0">
                            <div id="book_calender_one"></div>
                        </div>
                    </div>
                </div>
                @endcanany

                @canany(['Installation Calendar'])
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Installation Dubai</div>
                        </div>
                        <div class="card-body p-0">
                            <div id="install_time"></div>
                        </div>
                    </div>
                </div>

                @endcanany
                
                @canany(['Installation Calendar'])
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Installation Abu Dhabi</div>
                        </div>
                        <div class="card-body p-0">
                            <div id="install_time_abudhabi"></div>
                        </div>
                    </div>
                </div>

                @endcanany

            </div>
        </div>
    </section>
    <!-- /.content -->


    <!-- Modal for displaying BookTime data -->
    <div class="modal fade" id="bookTimeModal" tabindex="-1" role="dialog" aria-labelledby="bookTimeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookTimeModalLabel">Book Time Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- BookTime details will be loaded here -->
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Customer</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bookTimeDetails">
                            <!-- Data from the BookTime model will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for displaying BookTime Another data -->
    <div class="modal fade" id="bookTimeModalOne" tabindex="-1" role="dialog" aria-labelledby="bookTimeModalOneLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookTimeModalOneLabel">Book Time Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- BookTime details will be loaded here -->
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Customer</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bookTimeDetailsOne">
                            <!-- Data from the BookTime model will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for showing installation details -->
    <div class="modal fade" id="installModal" tabindex="-1" role="dialog" aria-labelledby="installModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="installModalLabel">Order Installation Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <p><strong>Install Date:</strong> <span id="install_date"></span></p>
                    <p><strong>Install Time:</strong> <span id="install_time"></span></p>
                    <p><strong>Install Note:</strong> <span id="install_note"></span></p>
                    <p><strong>Status:</strong> <span id="status"></span></p>
                </div>


            </div>
        </div>
    </div>
    
    <!-- Modal for showing installation details -->
    <div class="modal fade" id="installModalAbuDhabi" tabindex="-1" role="dialog" aria-labelledby="installModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="installModalLabel">Order Installation Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <p><strong>Install Date:</strong> <span id="install_date_1"></span></p>
                    <p><strong>Install Time:</strong> <span id="install_time_1"></span></p>
                    <p><strong>Install Note:</strong> <span id="install_note_1"></span></p>
                    <p><strong>Status:</strong> <span id="status_1"></span></p>
                </div>


            </div>
        </div>
    </div>

    @section('script')
    <!-- FullCalendar Script and AJAX Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('book_calender');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                selectable: true,
                dateClick: function(info) {
                    // Fetch all BookTime data and related Book data for the selected date
                    fetchBookTimes(info.dateStr);
                }
            });

            calendar.render();
        });

        function fetchBookTimes(date) {
            $.ajax({
                url: '{{ route("getAllBookTimes") }}', // Route to fetch all BookTime data and related Book entries
                type: 'GET',
                data: {
                    date: date
                },
                success: function(response) {
                    // Load BookTime and Book details into the modal and show the modal
                    $('#bookTimeDetails').html(response);
                    $('#bookTimeModal').modal('show');
                },
                error: function() {
                    alert('Error fetching data');
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('book_calender_one');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                selectable: true,
                dateClick: function(info) {
                    // Fetch all BookTime data and related Book data for the selected date
                    fetchBookTimesAnother(info.dateStr);
                }
            });

            calendar.render();
        });

        function fetchBookTimesAnother(date) {
            $.ajax({
                url: '{{ route("getAllBookTimesAnother") }}', // Route to fetch all BookTime data and related Book entries
                type: 'GET',
                data: {
                    date: date
                },
                success: function(response) {
                    // Load BookTime and Book details into the modal and show the modal
                    $('#bookTimeDetailsOne').html(response);
                    $('#bookTimeModalOne').modal('show');
                },
                error: function() {
                    alert('Error fetching data');
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('install_time');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                selectable: true,
                editable: false,
                events: '/orders/get-installation-data', // URL to fetch the orders
                eventClick: function(info) {
                    var orderId = info.event.id;

                    // Fetch order details via AJAX and show them in a modal
                    $.ajax({
                        url: '/orders/' + orderId,
                        method: 'GET',
                        success: function(data) {
                            // Populate modal fields with the returned data
                            $('#installModal #install_date').text(data.install_date);
                            $('#installModal #install_time').text(data.install_time);
                            $('#installModal #install_note').text(data.install_note);
                            $('#installModal #status').text(data.status);

                            // Show the modal
                            $('#installModal').modal('show');
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('install_time_abudhabi');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                selectable: true,
                editable: false,
                events: '/orders/get-installation-data-abu-dhabi', // URL to fetch the orders
                eventClick: function(info) {
                    var orderId = info.event.id;

                    // Fetch order details via AJAX and show them in a modal
                    $.ajax({
                        url: '/orders/' + orderId,
                        method: 'GET',
                        success: function(data) {
                            // Populate modal fields with the returned data
                            $('#installModalAbuDhabi #install_date_1').text(data.install_date);
                            $('#installModalAbuDhabi #install_time_1').text(data.install_time);
                            $('#installModalAbuDhabi #install_note_1').text(data.install_note);
                            $('#installModalAbuDhabi #status_1').text(data.status);

                            // Show the modal
                            $('#installModalAbuDhabi').modal('show');
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>
    @endsection
</x-admin-app-layout>