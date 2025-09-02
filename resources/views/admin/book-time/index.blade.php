<x-admin-app-layout>
@section('title')
       Booking Time
    @endsection
    @section('css')
    @endsection
    <section class="content pt-4">
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
                            <h3 class="card-title font-weight-bold">Booking Times</h3>
                            <button id="create-new-post" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#time"><i class="fas fa-plus"></i> Add New</button>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="12%">SL No</th>
                                        <th>Name</th>
                                        <th width="12%">Status</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <span class="badge badge-primary p-2">Active</span>
                                                @else
                                                    <span class="badge badge-danger p-2">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a data-toggle="modal" data-target="#show-{{ $row->id }}"
                                                    href="javascript:void(0)"
                                                    class="badge badge-secondary p-2 mr-2">View</a>
                                                <a data-toggle="modal" data-target="#time-{{ $row->id }}"
                                                    href="javascript:void(0)" class="badge badge-primary p-2 mr-2">Edit</a>
                                                
                                                <a onclick="deleteData({{ $row->id }})">
                                                    <i class="btn btn-danger fa fa-trash-alt"></i>
                                                </a>
                                               

                                                @include('admin.book-time.update')
                                                @include('admin.book-time.show')

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
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="time">
        <div class="modal-dialog time">
            <form id="countryForm" action="{{ route('admin.book-times.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title font-weight-bold">New Book Time +</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Enter name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" required class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.card -->
                                </div>

                            </div>
                        </section>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary bg-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                                url: "{{ url('admin/book-times') }}" + '/' + id, // Constructing the URL with the id
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
    @endsection
</x-admin-app-layout>