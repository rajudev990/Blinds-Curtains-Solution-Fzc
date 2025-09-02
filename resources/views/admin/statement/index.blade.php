<x-admin-app-layout>

    @section('title') Statements @endsection
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Statements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Statements</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
       <!-- Default box -->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Statements</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Order Subtotal</th>
                        <th>Order Total</th>
                        <th>Paid Amount</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $order)
                        <tr>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->order_subtotal }}</td>
                            <td>{{ $order->order_total }}</td>
                            <td>
                                AED {{ $order->orderDetails->sum('amount') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.statements.print',$order->order_code) }}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    </section>
    <!-- /.content -->
    @section('script')

    @endsection
</x-admin-app-layout>