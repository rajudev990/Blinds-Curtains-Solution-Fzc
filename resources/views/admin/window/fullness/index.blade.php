<x-admin-app-layout>

    @section('title')
        FullNess 
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FullNess</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">FullNess</li>
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
                    @canany(['FullNess create'])
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.fullness.create') }}" class="btn btn-primary custom-btn">Add FullNess</a>
                    </div>
                    @endcan
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @canany(['FullNess access'])
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Deactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @canany(['FullNess edit'])
                                                <a href="{{ route('admin.fullness.show', $row->id) }}" class="btn btn-sm btn-secondary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                

                                                <a href="{{ route('admin.fullness.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @canany(['FullNess delete'])
                                                <a onclick="deleteData({{ $row->id }})" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endcan
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
                            url: "{{ url('admin/fullness') }}" + '/' + id, // Constructing the URL with the id
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
