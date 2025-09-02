<x-admin-app-layout>

    @section('title') Subscriber List @endsection
    @section('css')
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscriber List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Subscriber List</li>
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
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->name }}

                                        </td>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->discount }}%</td>

                                        <td class="text-center">

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch-{{ $item->id }}" {{ $item->status==1 ? 'checked' : '' }} onclick="toggleStatus({{ $item->id }})">
                                                <label class="custom-control-label" for="customSwitch-{{ $item->id }}"></label>
                                            </div>
                                            <span class="text-success">{{ $item->created_at->diffForHumans() }}</span>

                                        </td>
                                        <td class="text-center">
                                            <a onclick="deleteData({{ $item->id }})">
                                                <i class="btn btn-danger btn-sm fa fa-trash-alt"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-primary">
                                        <td colspan="5">Data not found !!!</td>
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
                            url: "{{ url('admin/subscribers') }}" + '/' + id, // Constructing the URL with the id
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
    <script>
        function toggleStatus(id) {
            let isChecked = document.getElementById(`customSwitch-${id}`).checked;
            let status = isChecked ? 1 : 0;

            fetch(`/admin/update-subscriber-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show Toastr notification on success
                        toastr[data.alert_type](data.message);
                    } else {
                        // Show Toastr notification on failure
                        toastr[data.alert_type](data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    @endsection
</x-admin-app-layout>