<x-admin-app-layout>

    @section('title')
    View Book
    @endsection
    @section('css')

    @endsection


    <!-- Main content -->
    <section class="content pt-4">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info d-flex justify-content-between">
                        <h5><i class="fas fa-info"></i> Hey: {{ $data->name }}</h5>
                        <a href="{{ url()->previous() }}" class="bg-dark btn btn-dark btn-sm text-decoration-none">Back</a>
                        <!-- <a href="{{ route('admin.books.index') }}" class="bg-dark btn btn-dark btn-sm text-decoration-none">Back</a> -->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="dataTable table table-bordered table-hover table-striped">

                                <tr>
                                    <th>City</th>
                                    <td>{{ $data->city }}</td>
                                </tr>
                                <tr>
                                    <th>Booking ID</th>
                                    <td>{{ $data->book_id }}</td>
                                </tr>
                                <tr>
                                    <th>Booking Date</th>
                                    <td>{{ \Carbon\Carbon::parse($data->booking_date)->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th>Booking Slot</th>
                                    <td>{{ $data->bookingTime->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $data->phone_country }} {{ $data->phone_code }} {{ $data->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Community / Building Name</th>
                                    <td> {{ $data->address }}</td>
                                </tr>
                                <tr>
                                    <th>Falt No / Villa No</th>
                                    <td>{{ $data->flat_no }}</td>
                                </tr>
                                <tr>
                                    <th>Windows No</th>
                                    <td>{{ $data->windows_number }}</td>
                                </tr>
                                <tr>
                                    <th>Blinds/Curtains Type</th>
                                    <td>{{ $data->type }}</td>
                                </tr>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

    @section('script')

    @endsection
</x-admin-app-layout>