<x-admin-app-layout>
    @section('title') Social Share Link @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('admin.social_link.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="facebook">Facebook :</label>
                                            <input type="url" class="form-control" value="{{ $data->facebook }}" name="facebook" id="facebook" placeholder="Enter facebook">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="twitter">Twitter :</label>
                                            <input type="url" class="form-control" value="{{ $data->twitter }}" name="twitter" id="twitter" placeholder="Enter twitter">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="linkedin">Linkedin :</label>
                                            <input type="url" class="form-control" value="{{ $data->linkedin }}" name="linkedin" id="linkedin" placeholder="Enter linkedin">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="instagram">Instagram :</label>
                                            <input type="url" class="form-control" value="{{ $data->instagram }}" name="instagram" id="instagram" placeholder="Enter instagram">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="pinterest">Pinterest :</label>
                                            <input type="url" class="form-control" value="{{ $data->pinterest }}" name="pinterest" id="pinterest" placeholder="Enter pinterest">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Deactive
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-footer d-flex justify-content-end bg-white pb-5">

                                <a href="{{ route('admin.social_link.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                <button class="btn btn-primary ml-3 custom-btn" type="submit">Update</button>

                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</x-admin-app-layout>