<x-admin-app-layout>
@section('title') All Products @endsection
@section('css')
<style>
    .table td{
        padding:5px !important;
    }
</style>
@endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Products List</li>
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

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary custom-btn">Add New Products</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sl No</th>
                                        <th style="width: 45%;">Name</th>
                                        <th style="width: 30%;">Size / Price</th>
                                        <th>Featured</th>
                                        <th>Estimated</th>
                                        <th>Status</th>
                                        <th style="width: 15%;">Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="d-lg-flex justify-content-lg-start">
                                            <div>
                                                <img src="{{ Storage::url($item->image) }}" alt="Banner image" width="50px" height="50px">
                                            </div>
                                            <div>
                                                <span class="ml-2 d-block">Name : {{ $item->title }}</span>
                                                <span class="ml-2 d-block">Category Name : {{ $item->category->name }}</span>
                                                <span class="ml-2 d-block">Price Rate : {{ $item->price_rate }}</span>
                                                <span class="ml-2 d-block">Base Charge : {{ $item->base_charge }}</span>
                                                <span class="ml-2 d-block">Additional Charge : {{ $item->additional_charge }}</span>
                                                <span class="ml-2 d-block">Style : {{ $item->style ? $item->style : 'null' }}</span>
                                                
                                            </div>

                                        </td>
                                        <td>
                                            @foreach($item->sizes as $size)
                                                {{ $size->width }} X {{ $size->height }} {{ $item->cm_length }}  = {{ $size->price }} <br>
                                            @endforeach
                                        </td>
                                        
                                        <td>
                                            @if($item->featured_status == 1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->estimate_status == 1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <!--<a href="{{ route('admin.product.show',$item->id) }}">-->
                                            <!--    <i class="fa fa-eye btn btn-secondary"></i>-->
                                            <!--</a>-->
                                            <a href="{{ route('admin.product.edit',$item->id) }}">
                                                <i class="fa fa-edit btn btn-primary btn-sm"></i>
                                            </a>

                                            <a onclick="deleteData({{ $item->id }})">
                                                <i class="btn btn-danger fa fa-trash-alt btn-sm"></i>
                                            </a>

                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr class="text-center text-primary">
                                        <td colspan="7">Data not found !!!</td>
                                    </tr>
                                    @endforelse
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
                            url: "{{ url('admin/product') }}" + '/' + id, // Constructing the URL with the id
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
                                    location.reload(); // Optionally, you can reload the page or table data
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
    @endsection
</x-admin-app-layout>