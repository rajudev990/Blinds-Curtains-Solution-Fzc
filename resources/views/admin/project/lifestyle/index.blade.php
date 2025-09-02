<x-admin-app-layout>

    @section('title') Life Style Title @endsection
    @section('css')
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Life Style Title</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Life Style Title</li>
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
                        <a href="{{ route('admin.life-style-title.create') }}" class="btn btn-primary custom-btn">Add New Style Title</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Life Style Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                       
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.life-style-title.show',$item->id) }}">
                                                <i class="fa fa-eye btn btn-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.life-style-title.edit',$item->id) }}">
                                                <i class="fa fa-edit btn btn-primary"></i>
                                            </a>

                                            <a onclick="deleteData({{ $item->id }})">
                                                <i class="btn btn-danger fa fa-trash-alt"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-primary">
                                        <td colspan="4">Data not found !!!</td>
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
                            url: "{{ url('admin/life-style-title') }}" + '/' + id, // Constructing the URL with the id
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