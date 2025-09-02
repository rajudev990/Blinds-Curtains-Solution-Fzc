<div class="modal fade" id="time-{{ $row->id }}">
    <div class="modal-dialog time">
        <form id="countryForm" action="{{ route('admin.book-times.update',$row->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="bg-primary modal-header">
                    <h4 class="modal-title font-weight-bold">Update Book Time</h4>
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
                                        <input type="text" name="name" class="form-control"
                                            id="name" placeholder="Enter name" required value="{{ $row->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" required class="form-control">
                                            <option value="1" {{ $row->status==1 ? 'selected':'' }}>Active</option>
                                            <option value="0" {{ $row->status==0 ? 'selected':'' }}>Deactive</option>
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
                    <button type="submit" class="btn btn-primary bg-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>