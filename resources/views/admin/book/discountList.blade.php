<x-admin-app-layout>

    @section('title')
    Discount List
    @endsection
    @section('css')
    <style>
        .dropdown-menu{
            transform: translate3d(-42px, 38px, 0px) !important;
        }
        .dropdown-divider{
            margin: 0 !important;
        }
    </style>
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Discount List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Discount List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="8%">ID</th>
                                        <th>Customer Info</th>
                                        <th width="23%">Booking</th>
                                        <th>Orders</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $item)
                                   
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }} <br>
                                            <span class="badge badge-{{ $item->status=='pending' ? 'warning' : 'success' }}">{{ $item->status }}</span>
                                        </td>
                                        <td>
                                            <span class="font-weight-bold">City : </span> {{ $item->city ? $item->city : 'Empty' }} <br>
                                            <span class="font-weight-bold">Name : </span> {{ $item->name }} <br>
                                            <span class="font-weight-bold">Email : </span> {{ $item->email }} <br>
                                            <span class="font-weight-bold">Phone : </span> {{ $item->phone }}
                                        </td>

                                        <td>
                                            <span class="font-weight-bold">Date : </span> {{ \Carbon\Carbon::parse($item->booking_date)->format('Y-m-d') }}<br>
                                            <span class="font-weight-bold">Time : </span> {{ $item->bookingTime->name }} <br>
                                            <span class="font-weight-bold">ID : </span> <a href="{{ route('admin.books.show',$item->id) }}">{{ $item->book_id }}</a>

                                        </td>

                                        <td>
                                            @foreach ($item->orders as $order)
                                            @if($order->status=='discount')
                                            <a href="{{ route('admin.order.create', $order->order_code) }}" class="font-weight-bold">
                                                {{ $order->order_code }} : show |
                                                
                                                @if($order->OrderItems->count() && $order->order_total != null)

                                                    @if($order->mail_send=='pending')
                                                    <a href="{{ route('admin.book.send-user', $order->order_code) }}" class="font-weight-bold" onclick="return confirmDelete();">
                                                        Discount User |
                                                    </a>
                                                    @else
                                                    <a href="{{ route('admin.book.send-user', $order->order_code) }}" class="font-weight-bold text-success" onclick="return confirmDelete();">
                                                        {{\Carbon\Carbon::parse($order->mail_send_date)->diffForHumans() }} |
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('admin.order.remove', $order->id) }}" class="font-weight-bold text-danger" onclick="return confirm('Are you sure you want to delete this order?');">
                                                        Remove
                                                    </a>

                                                    <span class="text-warning">{{ $order->status==='discount' ? 'Marketer send for discount' : '' }}</span>
                                                @else
                                                Empty Item
                                            
                                                @endif
                                            </a>
                                            
                                            <br>
                                            @endif
                                            @endforeach
                                        </td>

                                        <td class="text-center">
                                           
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="sr-only">Toggle Dropdown</span></button>
                                
                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item" href="{{ route('admin.order.index', $item->id) }}"><i class="fa fa-plus"></i> Create</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('admin.books.show',$item->id) }}"><i class="fa fa-eye"></i> View</a>
                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item" href="{{ route('admin.books.cancel',$item->id) }}"><i class="fa fa-times"></i> Cancel</a>

                                                    <div class="dropdown-divider"></div>

                                                    <a style="cursor: pointer;" class="dropdown-item" onclick="deleteData({{ $item->id }})"><i class="fa fa-trash"></i> Delete</a>

                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                   
                                    @endforeach


                                </tbody>

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
    <script type="text/javascript">
        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('admin/books') }}" + '/' + id, // Constructing the URL with the id
                            type: "POST",
                            data: {
                                '_method': 'DELETE',
                                '_token': csrf_token
                            },
                            success: function(data) {
                                // Reload the table or handle success response
                                swal({
                                    title: `Delete Done!`,
                                    text: "You clicked the button!",
                                    icon: "success",
                                    buttons: "Done",
                                }).then(() => {
                                    location
                                        .reload(); // Optionally, you can reload the page or table data
                                });
                            },
                            error: function() {
                                swal({
                                    title: `Oops...`,
                                    text: "Something went wrong!",
                                    icon: "error",
                                    buttons: "OK",
                                });
                            }
                        });
                    } else {
                        swal("Your data is safe!");
                    }
                });
        }
    </script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this order?");
        }
    </script>
    @endsection
</x-admin-app-layout>