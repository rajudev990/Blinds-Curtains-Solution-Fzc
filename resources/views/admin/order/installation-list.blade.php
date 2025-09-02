<x-admin-app-layout>

    @section('title')
    Installation List
    @endsection
    @section('css')
    <style>
        .dropdown-menu {
            transform: translate3d(-42px, 38px, 0px) !important;
        }

        .dropdown-divider {
            margin: 0 !important;
        }
        .active-btn {
            background-color: #008000 !important; /* Change to your desired active color */
            color: #fff;
            border-color: #008000 !important;
        }
        
    </style>
    
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Installation List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Installation List</li>
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
                
                <div class="col-12 mb-2">
                    <a href="{{ route('admin.order.installation-list', ['status' => 'all']) }}" 
                       class="btn btn-sm btn-primary {{ request('status') == 'all' || !request('status') ? 'active-btn' : '' }}">All</a>
                    <a href="{{ route('admin.order.installation-list', ['status' => 'installation-processing']) }}" 
                       class="btn btn-sm btn-primary {{ request('status') == 'installation-processing' ? 'active-btn' : '' }}">Processing</a>
                    <a href="{{ route('admin.order.installation-list', ['status' => 'installation-completed']) }}" 
                       class="btn btn-sm btn-primary {{ request('status') == 'installation-completed' ? 'active-btn' : '' }}">Completed</a>
                </div>
                
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <!--<table id="example1" class="table table-bordered table-hover">-->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="8%">ID</th>
                                        <th>Customer Info</th>
                                        <th>Booking Info</th>
                                        <th>Installation Info</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>   
                                </thead>
                                <tbody>

                                    @forelse ($data as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }} <br>
                                            <span class="badge badge-success">{{ $item->payment_status }}</span>
                                        </td>
                                        <td>
                                            <span>City : </span> {{ $item->book?->city }} <br>
                                            <span>Name : </span> {{ $item->book?->name }} <br>
                                            <span>Email : </span> {{ $item->book?->email }} <br>
                                            <span>Phone : </span> {{ $item->book?->phone }}
                                        </td>

                                        <td>
                                            <span>Date : </span> {{ \Carbon\Carbon::parse($item->book?->booking_date)->format('Y-m-d') }}<br>
                                            <span>Time : </span> {{ $item->book->bookingTime?->name }} <br>
                                            <span>Book ID : </span> <a href="{{ route('admin.books.show',$item->book->id) }}">{{ $item->book?->book_id }}</a><br>
                                            <span>Order ID : </span> {{ $item->order_code }}
                                            

                                        </td>
                                        
                                        
                                        <td>
                                            <span>Date : </span> {{ \Carbon\Carbon::parse($item->install_date)->format('Y-m-d') }}<br>
                                            <span>Shedule : </span> {{ $item->install_time }} <br>
                                            <span>Note : </span> {{ $item->install_note }}
                                            

                                        </td>

                                        {{--<td>
                                            <span>Order : </span> {{ $item->order_code }} <br>
                                            <span>Sub Total : </span> {{ number_format($item->order_total,2) }} <br>
                                            <span>Total : </span> {{ number_format($item->order_total - (($item->coupon / 100) * $item->order_total),2) }} <br>
                                           
                                            @if($item->coupon)
                                            <span>Coupon : </span> {{ $item->coupon }}% <br>
                                            <span>Paid : </span> {{ number_format($item->orderDetails->sum('amount'),2) }} <br>
                                            <span class="text-success font-weight-bold">Due : {{ number_format(($item->order_total - (($item->coupon / 100) * $item->order_total)) - $item->orderDetails->sum('amount'),2)  }}</span>
                                            @else
                                            <span>Paid : </span> {{ number_format($item->orderDetails->sum('amount'),2) }} <br>
                                            <span class="text-success font-weight-bold">Due : {{  number_format($item->order_total - $item->orderDetails->sum('amount'),2) }}</span>
                                            @endif
                                           
                                        </td>--}}
                                        
                                         <td>
                                                @if($item->status==='installation')
                                                    <span class="text-success">Pending Installation</span>
                                                @elseif ($item->status==='installation-processing')
                                                    <span class="text-danger">Processing</span> <br>
                                                @elseif ($item->installation_status==='installation-completed')
                                                    <span class="text-success">Completed</span> <br>
                                                @endif  
                                        </td>

                                        <td class="text-center">

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="sr-only">Toggle Dropdown</span></button>

                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item" href="{{ route('admin.order.view',$item->id) }}"><i class="fa fa-eye"></i> View</a>
                                                    <div class="dropdown-divider"></div>
                                                    
                                                    @if($item->status==='installation')
                                                    <a class="dropdown-item" href="{{ route('admin.installation.processing',$item->id) }}"><i class="fa fa-cart-plus"></i> Accept</a>
                                                    <div class="dropdown-divider"></div>
                                                   
                                                    @endif
                                                    
                                                    @if($item->status !='feedback')
                                                    <a class="dropdown-item" href="{{ route('admin.installation.confirm',$item->id) }}"><i class="fa fa-check-circle"></i> Confirm</a>
                                                    <div class="dropdown-divider"></div>
                                                    @endif
                                                    <a class="dropdown-item" href="{{ route('admin.installation.feedback',$item->order_code) }}"><i class="fa fa-reply"></i> FeedBack</a>
                                                    <div class="dropdown-divider"></div>
                                                    
                                                </div>
                                            </div>

                                       
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-primary">
                                        <td colspan="5">Data Not Found !!!</td>
                                    </tr>
                                    @endforelse


                                </tbody>
                                
                               {{ $data->links() }}

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