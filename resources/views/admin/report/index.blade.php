<x-admin-app-layout>

    @section('title') Reports @endsection
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-lg-4">
                    <label for="from">From</label>
                    <input type="date" name="from" id="from" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="to">To</label>
                    <input type="date" name="to" id="to" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="discount">Discount</option>
                        <option value="cancel">Cancel</option>
                        <option value="block">Block</option>
                        <option value="payment">Payment</option>
                        <option value="installation">Installation</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="ordersTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Order Subtotal</th>
                                        <th>Order Total</th>
                                        <th>Discount</th>
                                        <th>Paid Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
    <!-- Include DataTables Export Buttons -->
    <script>
        $(document).ready(function() {
            loadOrders();

            // Load orders based on filter criteria
            function loadOrders(from = '', to = '', status = 'all') {
                $('#ordersTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.order.filter') }}", // Route to fetch filtered orders
                        data: {
                            from: from,
                            to: to,
                            status: status
                        }
                    },
                    columns: [{
                            data: 'order_code',
                            name: 'order_code'
                        },
                        {
                            data: 'order_subtotal',
                            name: 'order_subtotal'
                        },
                        {
                            data: 'order_total',
                            name: 'order_total'
                        },
                        {
                            data: 'order_coupon',
                            name: 'order_coupon'
                        },
                        {
                            data: 'paid_total',
                            name: 'paid_total'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                        'print'
                    ]
                });
            }

            // Filter orders when any filter input changes
            $('#from, #to, #status').on('change', function() {
                var from = $('#from').val();
                var to = $('#to').val();
                var status = $('#status').val();

                // Reload DataTable with new filters
                $('#ordersTable').DataTable().destroy(); // Destroy existing table
                loadOrders(from, to, status); // Reload with new filters
            });
        });
    </script>
    @endsection
</x-admin-app-layout>