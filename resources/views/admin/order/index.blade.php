<x-admin-app-layout>
    @section('title')
    Create Order
    @endsection
    @section('css')
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Item</li>
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

                <div class="col-lg-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="">
                            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close"><span
                                    class="text-white" aria-hidden="true">&times;</span></button>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <div>
                                <h3 class="card-title font-weight-bold">Order Notes</h3>
                            </div>
                            @if($order->order_total != null)
                            <div class="float-right">
                                <button id="share" class="btn btn-primary btn-sm">Share</button>
                                <input type="hidden" id="copy" value="{{ route('admin.order.checkout',$order->order_code) }}">
                            </div>
                            @endif
                        </div>

                        <form action="{{ route('admin.order.note.create', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note</label>
                                            <input type="text" class="form-control" name="order_note"
                                                value="{{ $order->order_note }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Media</label>
                                            <input type="file" class="form-control p-1" name="order_media" value="{{ $order->order_media }}">
                                            @if($order->order_media)
                                            <a target="_blank" href="{{ Storage::url($order->order_media) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Order #{{ $order->order_code }} (Bokking Code
                                #{{ $order->book?->book_id }})
                            </h3>
                            <h3 class="card-title">Name : {{$order->book?->name }}, Email : {{ $order->book?->email }}, Phone : {{ $order->book->phone }}</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Items</h3>

                            <div class="order_details d-flex justify-content-end">
                                <h3 class="card-title mr-4">Cost</h3>
                                <h3 class="card-title mr-4">Qty</h3>
                                <h3 class="card-title">Total</h3>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="card-header d-flex justify-content-between">
                                <p class="font-weight-bold">Project Name</p>
                                <p class="font-weight-bold">Project Details</p>
                                <p class="font-weight-bold">Project Price</p>
                                <p class="font-weight-bold">Action</p>
                            </div>

                            <div class="card-body">
                                @foreach ($OrderItems as $row)
                                @if ($row->order_type == 'windows')
                                <div class="d-flex justify-content-between p-2" style="background-color:#F7F7F7;">
                                    <div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if ($row->product?->image !== null)
                                                <img class="img-fluid" style="width: 100px;height:100px;" src="{{ Storage::url($row->product->image) }}">
                                                @endif
                                            </li>
                                        </ul>
                                        <a>
                                            {{ $row->product?->title }}
                                        </a>
                                        <br />
                                        <strong>
                                            {{ $row->window_name }}


                                        </strong>
                                    </div>
                                    <div>
                                        <span><span class="font-weight-bold">Width:</span> {{ $row->width }} {{ $row->product->cm_length }}, <span class="font-weight-bold">Left:</span> {{ $row->height_left }} {{ $row->product->cm_length }}, <span class="font-weight-bold">Middle:</span> {{ $row->height_middle }} {{ $row->product->cm_length }}, <span class="font-weight-bold">Right:</span> {{ $row->height_right }} {{ $row->product->cm_length }}</span> <br>


                                        <span><span class="font-weight-bold">SKU:</span> {{ $row->product?->sku }}</span> <br>

                                        @foreach ($row->catalogueItems as $item)
                                        <div>
                                            <span class="font-weight-bold">Catalogue Name: </span>
                                            <span>{{ $item->catalogue->name ?? 'N/A' }}</span><br>

                                            <span class="font-weight-bold">Catalogue Book Name: </span>
                                            <span>{{ $item->catalogueBook->name ?? 'N/A' }}</span><br>

                                            <span class="font-weight-bold">Page Number: </span>
                                            <span>{{ $item->pageNumber->name ?? 'N/A' }}</span><br>
                                            
                                            <span class="font-weight-bold">Total Fabric Qty: </span>
                                            <span>{{ $item->qty ?? 'N/A' }} meters</span><br>
                                        </div>
                                        @endforeach


                                        <span><span class="font-weight-bold">Comment:</span> {{ $row->comment }}</span> <br>
                                        <span><span class="font-weight-bold">Fullness:</span> {{ $row->fullness }}</span> <br>
                                        <span><span class="font-weight-bold">Pooling:</span> {{ $row->polling }}</span> <br>
                                        <span><span class="font-weight-bold">Openning:</span> {{ $row->opening }}</span> <br>
                                        <span><span class="font-weight-bold">Lining:</span> {{ $row->lining }}</span> <br>
                                        <span><span class="font-weight-bold">Status: </span>@if($row->status=='1') <span class="text-success font-weight-bold">Active</span> @else <span class="text-danger font-weight-bold">Deactive</span>@endif<br>
                                    </div>
                                    <div>
                                        @php
                                        $totalWindows = 0;
                                        $itemCost = 0;
                                    
                                        // Ensure dimensions are numeric
                                        $width = floatval($row->width ?? 0);
                                        $heightLeft = floatval($row->height_left ?? 0);
                                        $heightMiddle = floatval($row->height_middle ?? 0);
                                        $heightRight = floatval($row->height_right ?? 0);
                                    
                                        // Ensure product-related charges are numeric
                                        $priceRate = floatval($row->product?->price_rate ?? 0);
                                        $baseCharge = floatval($row->product?->base_charge ?? 0);
                                        $additionalCharge = floatval($row->product?->additional_charge ?? 0);
                                    
                                        // Ensure quantity is numeric
                                        $qty = intval($row->qty ?? 0);
                                    
                                        // Calculate the largest height
                                        $largestHeight = max([$heightLeft, $heightMiddle, $heightRight]);
                                    
                                        // Calculate item cost based on conditions
                                        if ($width > 280 && $largestHeight > 260) {
                                            $itemCost = (($width * $largestHeight) / 10000) * $priceRate +
                                                        $baseCharge +
                                                        (($width * $largestHeight) / 10000) * $additionalCharge;
                                        } else {
                                            $itemCost = (($width * $largestHeight) / 10000) * $priceRate +
                                                        $baseCharge;
                                        }
                                    
                                        // Multiply by quantity to get totalWindows
                                        $totalWindows = $itemCost * $qty;
                                    @endphp
                                    
                                    {{ number_format($itemCost, 2) }} X {{ $qty }} = AED {{ number_format($totalWindows, 2) }}

                                    </div>
                                    <div style="position:relative;">
                                        <a href="{{ route('admin.item.copy', $row->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-copy"></i>
                                        </a>

                                        <a type="button" data-toggle="modal"
                                            data-target="#windowEditModal-{{ $row->id }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('admin.order.windowEdit')

                                        <a href="{{ route('admin.item.delete', $row->id) }}" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <a type="button" data-toggle="modal"
                                            data-target="#windowItem-{{ $row->id }}" href="#" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-plus"></i>
                                        </a>

                                        @include('admin.order.windowItem')
                                    </div>
                                </div>
                                @php
                                
                                    // Get all rows where window_id matches the current row's id
                                    $relatedRows = $OrderItems->filter(function ($item) use ($row) {
                                        return $item->window_id == $row->id;
                                    });
                                
                                @endphp
                                @if ($relatedRows->isNotEmpty())
                                @foreach ($relatedRows as $relatedRow)
                              
                                <div class="d-flex justify-content-between p-2" style="background-color:#F7F7F7;">
                                    <div>
                                        
                                    </div>
                                    <div class="d-flex">
                                        
                                        <div>
                                            <ul class="list-inline mr-2">
                                                <li class="list-inline-item">
                                                    @if ($relatedRow->product?->image !== null)
                                                    <img class="img-fluid" style="width: 100px;height:100px;" src="{{ Storage::url($relatedRow->product->image) }}">
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                       
                                       <div>
                                            <a>
                                            {{ $relatedRow->product?->title }}
                                            </a>
                                            <br />
                                            <strong>
                                                {{ $row->window_name }}
                                            </strong>
                                            
                                            <span><span class="font-weight-bold">SKU:</span> {{ $relatedRow->product?->sku }}</span> <br>
                                            <span><span class="font-weight-bold">Description:</span> {{ $relatedRow->description }}</span> <br>
                                            <span><span class="font-weight-bold">Status: </span>@if($relatedRow->status=='1') <span class="text-success font-weight-bold">Active</span> @else <span class="text-danger font-weight-bold">Deactive</span>@endif<br>

                                       </div>
                                       
                                    </div>
                                    <div>
                                        @if($relatedRow->product->cm_length=='per piece')

                                        {{ $relatedRow->product->price_rate + $relatedRow->product->base_charge }} X {{ $relatedRow->qty }} =
                                        AED {{ ($relatedRow->product->price_rate + $relatedRow->product->base_charge) * $relatedRow->qty }}



                                        @elseif($relatedRow->product->cm_length=='per line meter')

                                        {{ (($relatedRow->width / 100) * ($relatedRow->product->price_rate + $relatedRow->product->base_charge)) }} X {{ $relatedRow->qty }} =
                                        AED {{ (($relatedRow->width / 100) * ($relatedRow->product->price_rate + $relatedRow->product->base_charge)) * $relatedRow->qty }}



                                        @endif
                                    </div>
                                    <div>
                                        
                                        <a href="{{ route('admin.item.copy', $relatedRow->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-copy"></i>
                                        </a>

                                        <a type="button" data-toggle="modal"
                                            data-target="#WindowEditModal-{{ $relatedRow->id }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('admin.order.windowItemEdit')

                                        <a href="{{ route('admin.item.delete', $relatedRow->id) }}" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                                @endforeach
                                @endif

                                @endif
                                @if($row->order_type == 'accessories' && is_null($row->window_id))
                                <hr>
                                <div class="d-flex justify-content-between mt-3">
                                    <div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if ($row->product?->image !== null)
                                                <img class="img-fluid" style="width: 100px;height:100px;" src="{{ Storage::url($row->product->image) }}">
                                                @endif
                                            </li>
                                        </ul>
                                        <a>
                                            {{ $row->product?->title }}
                                        </a>
                                        <br />
                                        <strong>
                                            {{ $row->window_name }}
                                        </strong>
                                    </div>
                                    <div>
                                        @if ($row->order_type == 'accessories')
                                        <span><span class="font-weight-bold">SKU:</span> {{ $row->product?->sku }}</span> <br>
                                        <span><span class="font-weight-bold">Description:</span> {{ $row->description }}</span> <br>
                                        <span><span class="font-weight-bold">Status: </span>@if($row->status=='1') <span class="text-success font-weight-bold">Active</span> @else <span class="text-danger font-weight-bold">Deactive</span>@endif<br>

                                        @endif
                                    </div>
                                    <div>
                                        @if($row->product->cm_length=='per piece')

                                        {{ $row->product->price_rate + $row->product->base_charge }} X {{ $row->qty }} =
                                        AED {{ ($row->product->price_rate + $row->product->base_charge) * $row->qty }}



                                        @elseif($row->product->cm_length=='per line meter')

                                        {{ (($row->width / 100) * ($row->product->price_rate + $row->product->base_charge)) }} X {{ $row->qty }} =
                                        AED {{ (($row->width / 100) * ($row->product->price_rate + $row->product->base_charge)) * $row->qty }}



                                        @endif
                                    </div>
                                    <div>
                                        @if ($row->order_type == 'accessories')
                                        <a href="{{ route('admin.item.copy', $row->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-copy"></i>
                                        </a>

                                        <a type="button" data-toggle="modal"
                                            data-target="#accessoryEditModal-{{ $row->id }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('admin.order.accessoriesEdit')

                                        <a href="{{ route('admin.item.delete', $row->id) }}" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                @endif


                                @endforeach
                            </div>


                        </div>

                        <div class="card-body" style="text-align: end !important">

                            @php
                                $totalWindows = 0;
                                $totalAccessories = 0;
                            
                                foreach ($OrderItems->where('status', '1') as $item) {
                                
                           
                                    $itemCost = 0; // Initialize $itemCost with a default value
                            
                                    // Ensure numeric values for dimensions
                                    $width = floatval($item->width ?? 0);
                                    $heightLeft = floatval($item->height_left ?? 0);
                                    $heightMiddle = floatval($item->height_middle ?? 0);
                                    $heightRight = floatval($item->height_right ?? 0);
                                    $qty = intval($item->qty ?? 0);
                            
                                    // Ensure product-related charges are numeric
                                    $priceRate = floatval($item->product?->price_rate ?? 0);
                                    $baseCharge = floatval($item->product?->base_charge ?? 0);
                                    $additionalCharge = floatval($item->product?->additional_charge ?? 0);
                            
                                    if ($item->order_type === 'windows') {
                                        // Get the largest height value among height_left, height_middle, and height_right
                                        $largestHeight = max([$heightLeft, $heightMiddle, $heightRight]);
                            
                                        // Calculate the item cost for windows based on width and height
                                        if ($width > 280 && $largestHeight > 260) {
                                            $itemCost = (($width * $largestHeight) / 10000) * $priceRate +
                                                        $baseCharge +
                                                        (($width * $largestHeight) / 10000) * $additionalCharge;
                                        } else {
                                            $itemCost = (($width * $largestHeight) / 10000) * $priceRate +
                                                        $baseCharge;
                                        }
                            
                                        // Multiply by quantity and add to totalWindows
                                        $totalWindows += $itemCost * $qty;
                            
                                    } elseif ($item->order_type === 'accessories') {
                                        // Calculation for accessories
                                        if ($item->product->cm_length === 'per piece') {
                                            $lineCost = $priceRate + $baseCharge;
                                            $itemCost = $lineCost * $qty;
                                        } elseif ($item->product->cm_length === 'per line meter') {
                                            $lineCost = (($width / 100) * ($priceRate + $baseCharge));
                                            $itemCost = $lineCost * $qty;
                                        }
                            
                                        // Add to totalAccessories
                                        $totalAccessories += $itemCost;
                                    }
                                }
                            
                                
                                // Final subtotal
                                $subtotal = $totalWindows + $totalAccessories;
                            
                                // Apply coupon discount if available
                                $discountAmount = 0;
                                if ($order->order_coupon && $subtotal > 0) {
                                    $discountAmount = ($order->order_coupon / 100) * $subtotal;
                                    
                                }
                            
                                // Subtotal after discount
                                $subtotalAfterDiscount = $subtotal - $discountAmount;
                            
                                // Add 5% VAT
                                $vatAmount = (5 / 100) * $subtotalAfterDiscount;
                            
                                // Final total with VAT
                                $total = $subtotalAfterDiscount + $vatAmount;
                                
                                $paymonthly = $total / 3;
                            
                                
                                
                            @endphp



                            <p>Items Subtotal: <span class="ml-5">AED {{ number_format($subtotal, 2) }}</span>
                            </p>


                            <p>Payment Method: <span class="ml-5">Pay Upfront</span></p>

                            @if ($order->order_coupon && $subtotal > 0)

                            <p>Pay Monthly: <span class="ml-5">AED {{ number_format($paymonthly,2) }}</span></p>
                            
                            <p>Vat: <span class="ml-5 pl-4">AED {{ __('5.00') }}%</span></p>

                            <p>Coupon: <span class="ml-5 pl-3">AED {{ number_format($order->order_coupon,2) }}</span> %</p>
                            
                            <p>Order Total: <span class="ml-5">AED
                                    
                            {{ number_format($total, 2) }}
                            </span></p>
                                    
                                    
                                    

                            @else

                            <p>Pay Monthly: <span class="ml-5">AED {{ number_format($paymonthly,2) }}</span></p>
                            
                            <p>Vat: <span class="ml-5 pl-4">AED {{ __('5.00') }}%</span></p>

                            <p>Order Total: <span class="ml-5">AED 
                            <!--{{ number_format($total, 2) }}-->
                            
                            {{ number_format($total, 2) }}
                            
                            </span></p>

                            @endif

                        </div>



                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">

                                    <a type="button" data-toggle="modal" data-target="#windowModal"
                                        class="btn btn-outline-primary">
                                        Add Window(s)
                                    </a>
                                    @include('admin.order.window')

                                    <a data-toggle="modal" data-target="#AacessoriesModal"
                                        class="btn btn-outline-secondary ml-2">
                                        Add Accessories
                                    </a>
                                    @include('admin.order.accessories')

                                    <a type="button" data-toggle="modal" data-target="#couponModal"
                                        class="btn btn-outline-secondary ml-2">
                                        Apply Coupon
                                    </a>
                                    @include('admin.order.coupon')

                                    <input id="order_coupon" type="hidden" value="{{$order->order_coupon}}">

                                    <a type="button" class="btn btn-outline-success ml-2 save">save</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->

    @section('script')
    <script>
        $('.addItem').click(function(e) {
            e.preventDefault();
            $('.itemsMain').addClass('d-none');
            $('.items').removeClass('d-none');
        });

        $('.canlcel').click(function(e) {
            e.preventDefault();
            $('.items').addClass('d-none');
            $('.itemsMain').removeClass('d-none');
        });

        $('.save').on('click', function(e) {
            e.preventDefault();

            var order_id = "{{ $order->id }}";
            // var total = "{{ $total }}";
            var total = parseFloat("{{ $total }}").toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            var subtotal = parseFloat("{{ $subtotal }}").toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            var monthly = parseFloat("{{ $paymonthly }}").toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            // var subtotal = "{{ $subtotal }}";
            // var monthly = "{{ $paymonthly }}";
            var coupon = $('#order_coupon').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.order.save') }}",
                data: {
                    '_token': csrf_token,
                    order_id: order_id,
                    total: total,
                    subtotal: subtotal,
                    monthly: monthly,
                    coupon: coupon,
                },
                success: function(response) {
                    toastr.success(response.message);
                    window.location.href = "{{ route('admin.books.index') }}";
                }
            });

        });
    </script>
    <script>
        $(function() {

            $('#accessories-form').validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $(function() {

            $('#window-form').validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default action (navigation)
                var url = $(this).attr('href'); // Get the href attribute

                // Show the confirmation dialog
                if (confirm('Are you sure you want to delete this record?')) {
                    window.location.href = url; // If the user confirms, proceed with deletion
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#window_product_id', function() {
            var productId = $(this).val();

            if (productId) {
                $.ajax({
                    url: '{{ route('admin.fetch.catalogue') }}', // Add route here
                    type: 'GET',
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        $('#catalogue_select_container').empty(); // Clear previous content

                        if (response.catalogues && response.catalogues.length > 0) {

                            $.each(response.catalogues, function(index, catalogue) {
                                // Use rowIndex to assign a unique index to each row of catalogue, book, and page
                                var rowIndex = index + 1; // Start from 1 for each row

                                var selectHtml = `
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label for="catalogue_${catalogue.id}">Catalogue ${rowIndex}</label>
                                        <select id="catalogue_${catalogue.id}" class="form-control" name="catalogue_id[]">
                                            <option disabled selected>Select</option>
                                            <option value="${catalogue.id}">${catalogue.name}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="book_${catalogue.id}">Catalogue Book ${rowIndex}</label>
                                        <select id="book_${catalogue.id}" class="form-control" name="catalogue_book_id[]">
                                            <option disabled selected>Select Book</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="page_${catalogue.id}">Page Number ${rowIndex}</label>
                                        <select id="page_${catalogue.id}" class="form-control page-select" name="page_number_id[]">
                                            <option disabled selected>Select Pages</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="page_${catalogue.id}">Qty ${rowIndex}</label>
                                        <input type="text" id="qty_${catalogue.id}" class="form-control" name="catalouge_qty[]" readonly>
                                    </div>
                                </div>
                                `;
                                $('#catalogue_select_container').append(selectHtml);
                            });

                        } else {
                            $('#catalogue_select_container').append('<p>No catalogues found for this product.</p>');
                        }
                    },
                    error: function() {
                        $('#catalogue_select_container').html('<p>Error loading catalogues.</p>');
                    }
                });
            }
        });
        
        
        $(document).on('change', '.page-select', function() {
            var productId = $('#window_product_id').val(); // Get product ID from the main dropdown
            console.log("Product ID:", productId);
        
            var row = $(this).closest('.row'); // Find the closest row
            var catalogueId = row.find('select[name="catalogue_id[]"]').val();
            var bookId = row.find('select[name="catalogue_book_id[]"]').val();
            var pageId = $(this).val();
        
            if (catalogueId && bookId && pageId) {
                
                $.ajax({
                    url: '{{ route("admin.fetch.catalogue.book.details") }}',
                    type: 'GET',
                    data: {
                        catalogue_id: catalogueId,
                        book_id: bookId,
                        page_id: pageId,
                        product_id: productId, // Send product ID to the controller
                        width: $('input[name="width"]').val(),
                        height_left: $('input[name="height_left"]').val(),
                        height_middle: $('input[name="height_middle"]').val(),
                        height_right: $('input[name="height_right"]').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            row.find('input[name="catalouge_qty[]"]').val(response.qty);
                        } else {
                            alert('Error fetching book details');
                        }
                    },
                    error: function() {
                        alert('Error fetching book details');
                    }
                });

            }
        });

    </script>
    <script>
        // Event listener for Catalogue selection
        $(document).on('change', '[id^=catalogue_]', function() {
            var catalogueId = $(this).val(); // Get the selected catalogue ID
            var bookSelect = $(this).closest('.row').find('[id^=book_]'); // Find the book select in the same row
            var pageSelect = $(this).closest('.row').find('[id^=page_]'); // Find the page select in the same row

            if (catalogueId) {
                $.ajax({
                    url: '{{ route('admin.fetch.catalogueBooks') }}', // Add your route to fetch CatalogueBooks
                    type: 'GET',
                    data: {
                        catalogue_id: catalogueId
                    },
                    success: function(response) {
                        // Clear previous options in the book select box
                        bookSelect.empty().append('<option disabled selected>Select Book</option>');

                        if (response.catalogueBooks && response.catalogueBooks.length > 0) {
                            // Populate the book select with new options
                            $.each(response.catalogueBooks, function(index, book) {
                                bookSelect.append(`<option value="${book.id}">${book.name}</option>`);
                            });
                        } else {
                            bookSelect.append('<option disabled>No books available</option>');
                        }

                        // Clear the page select as well
                        pageSelect.empty().append('<option disabled selected>Select Pages</option>');
                    },
                    error: function() {
                        bookSelect.html('<option disabled>Error loading books</option>');
                    }
                });
            }
        });

        // Event listener for CatalogueBook selection
        $(document).on('change', '[id^=book_]', function() {
            var bookId = $(this).val(); // Get the selected book ID
            var pageSelect = $(this).closest('.row').find('[id^=page_]'); // Find the page select in the same row

            if (bookId) {
                $.ajax({
                    url: '{{ route('admin.fetch.pageNumbers') }}', // Add your route to fetch PageNumbers
                    type: 'GET',
                    data: {
                        book_id: bookId
                    },
                    success: function(response) {
                        // Clear previous options in the page select box
                        pageSelect.empty().append('<option disabled selected>Select Pages</option>');

                        if (response.pageNumbers && response.pageNumbers.length > 0) {
                            // Populate the page select with new options
                            $.each(response.pageNumbers, function(index, page) {
                                pageSelect.append(`<option value="${page.id}">${page.name}</option>`);
                            });
                        } else {
                            pageSelect.append('<option disabled>No pages available</option>');
                        }
                    },
                    error: function() {
                        pageSelect.html('<option disabled>Error loading pages</option>');
                    }
                });
            }
        });
        
        $(document).on('change', '[id^=page_]', function() {
            var pageId = $(this).val(); // Get the selected page ID
            var row = $(this).closest('.row'); // Get the current row
            var catalogueId = row.find('[id^=catalogue_]').val(); // Get selected catalogue ID
            var bookId = row.find('[id^=book_]').val(); // Get selected book ID
            // var productId = $('#edit_window_product_id').val(); 
            var productId = $('.edit_window_product_id').val(); 
        
            var width = $('#width').val(); // Get form width input value
            var heightLeft = $('#height_left').val(); // Get form height_left input value
            var heightMiddle = $('#height_middle').val(); // Get form height_middle input value
            var heightRight = $('#height_right').val(); // Get form height_right input value
            var qtyField = row.find('[id^=qty_]'); // Get the quantity input field
        
            if (pageId) {
                $.ajax({
                    url: '{{ route('admin.fetch.catalogueEditBookDetails') }}', // Laravel route for fetching details
                    type: 'GET',
                    data: {
                        catalogue_id: catalogueId,
                        book_id: bookId,
                        page_id: pageId,
                        product_id: productId,
                        width: width,
                        height_left: heightLeft,
                        height_middle: heightMiddle,
                        height_right: heightRight
                    },
                    success: function(response) {
                        if (response.success) {
                            qtyField.val(response.qty); // Update the quantity field
                        } else {
                            alert(response.message); // Show error message if any
                        }
                    },
                    error: function() {
                        alert('Error fetching data. Please try again.');
                    }
                });
            }
        });
    </script>

    <!-- image updalod -->
    <script>
        $(document).ready(function() {
            // Add more image input fields
            $('#add-more-images').click(function() {
                var newImageInput = `<div class="image-group d-flex mb-2">
            <input type="file" name="images[]" class="image-input form-control p-1" style="border-radius: 0px !important;">
            <button type="button" class="remove-image btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
        </div>`;
                $('#image-upload-section').append(newImageInput);
            });

            // Remove image input field
            $(document).on('click', '.remove-image', function() {
                $(this).parent('.image-group').remove();
            });

        });
    </script>
    <script>
        $(document).on('click', '.remove-existing-image', function() {
            var imageName = $(this).data('image-name');
            var imageDiv = $(this).parent('.image-preview');
            var rowId = imageDiv.data('id');

            $.ajax({
                url: '/admin/remove-order-items-image/' + rowId,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    image_name: imageName
                },
                success: function(response) {
                    alert('Image removed successfully!');
                    imageDiv.remove(); // Remove image from the view
                },
                error: function(response) {
                    console.error('Error:', response);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#share').on('click', function () {
                // Show alert
                alert('Successfully copied!');

                // Copy the value of the #copy element
                const copyText = $('#copy').val();
                const tempInput = $('<input>'); // Create a temporary input element
                $('body').append(tempInput);
                tempInput.val(copyText).select();
                document.execCommand('copy'); // Copy to clipboard
                tempInput.remove(); // Remove the temporary input
            });
        });

    </script>

    @endsection
</x-admin-app-layout>