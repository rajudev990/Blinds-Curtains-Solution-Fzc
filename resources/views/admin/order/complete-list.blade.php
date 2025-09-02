<x-admin-app-layout>

    @section('title')
    Complete Order List
    @endsection
    @section('css')
    <style>
        .dropdown-menu {
            transform: translate3d(-42px, 38px, 0px) !important;
        }

        .dropdown-divider {
            margin: 0 !important;
        }
    </style>
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Complete Order List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Complete Order List</li>
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
                                        <th>Booking</th>
                                        <th>Orders</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }} <br>
                                            <span class="badge badge-success">{{ $item->payment_status }}</span>
                                        </td>
                                        <td>
                                            <span>City : </span> {{ $item->book->city }} <br>
                                            <span>Name : </span> {{ $item->book->name }} <br>
                                            <span>Email : </span> {{ $item->book->email }} <br>
                                            <span>Phone : </span> {{ $item->book->phone }}
                                        </td>

                                        <td>
                                            <span>Date : </span> {{ \Carbon\Carbon::parse($item->book->booking_date)->format('Y-m-d') }}<br>
                                            <span>Time : </span> {{ $item->book->bookingTime->name }} <br>
                                            <span>ID : </span> <a href="{{ route('admin.books.show',$item->book->id) }}">{{ $item->book->book_id }}</a>
                                            

                                        </td>

                                        <td>
                                            <span>Order : </span> {{ $item->order_code }} <br>
                                            <span>Sub Total : </span> {{ $item->order_subtotal }} <br>
                                            {{--<span>Total : </span> {{ number_format($item->order_total - (($item->coupon / 100) * $item->order_total),2) }} <br>--}}
                                            
                                            <span>Vat : </span> 5.00 % <br>
                                            @if($item->order_coupon)
                                            <span>Discount : </span> {{$item->order_coupon}}.00% <br>
                                            @endif
                                            
                                            @if($item->coupon)
                                            <span>Coupon : </span> {{$item->coupon}}.00% <br>
                                            @endif
                                            
                                            <span>Total : </span> {{ $item->order_total}} <br>
                                            
                                            <span class="text-danger">Due : 
                                            
                                           @php
                                            if ($item->coupon) {
                                                // Ensure numeric values
                                                $orderTotal = (float) preg_replace('/[^0-9.]/', '', $item->order_total); // Remove non-numeric characters
                                                $coupon = (float) preg_replace('/[^0-9.]/', '', $item->coupon);
                                            
                                                // Perform calculation
                                                $total = (float) $orderTotal - (float)(($orderTotal * $coupon) / 100);
                                                $paid = (float) $item->orderDetails->sum('amount');
                                            
                                                // Compare floating-point numbers with a precision threshold
                                                if (abs($total - $paid) < 0.01) { 
                                                    $amount = 0; // All payment complete
                                                } else {
                                                    $amount = $total - $paid; // Remaining amount to be paid
                                                }
                                            } else {
                                                $orderTotal = (float) preg_replace('/[^0-9.]/', '', $item->order_total);
                                                $paid = (float) $item->orderDetails->sum('amount');
                                            
                                                if (abs($orderTotal - $paid) < 0.01) { 
                                                    $amount = 0; // All payment complete
                                                } else {
                                                    $amount = $orderTotal - $paid; // Remaining amount to be paid
                                                }
                                            }
                                        @endphp
                                        
                                        {{ number_format($amount, 2) }}
                                            
                                            
                                            </span>
                                           
                                        </td>

                                        <td class="text-center">

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="sr-only">Toggle Dropdown</span></button>

                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item" href="{{ route('admin.order.view',$item->id) }}"><i class="fa fa-eye"></i> View</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('admin.installation.feedback',$item->order_code) }}"><i class="fa fa-reply"></i> FeedBack</a>
                                                    <div class="dropdown-divider"></div>
                                                    
                                                </div>
                                            </div>

                                            <div>
                                                @if($item->status==='complete')
                                                    <span class="text-success">Book & Order Completed</span> <br>
                                                    <span>{{ $item->updated_at->diffForHumans() }}</span>
                                                @endif  
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
   
    @endsection
</x-admin-app-layout>