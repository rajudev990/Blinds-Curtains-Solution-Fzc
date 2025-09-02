<x-admin-app-layout>

    @section('title') Permission List @endsection
    @section('css')
    @endsection
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permission List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Permission List</li>
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
                <div class="col-12 text-right">
                    @canany('Permission create')
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary custom-btn mb-2">Create Permission</a>
                    @endcanany
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Permissions Name</th>
                                        <th>Created_At</th>
                                        <th>Updated_At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @canany('Permission access')
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $permission->name }}</td>

                                                <td>{{ $permission->created_at }}</td>
                                                <td>{{ $permission->updated_at }}</td>

                                                <td class="d-flex">


                                                    @canany('Permission edit')
                                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                            class="btn btn-primary btn-sm mr-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                    @endcanany

                                                    @canany('Permission delete')

                                                        <a class="btn btn-danger btn-sm" onclick="deleteData({{ $permission->id }})">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>

                                                    @endcanany
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endcanany

                                    


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
                            url: "{{ url('admin/permissions') }}" + '/' + id, // Constructing the URL with the id
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
