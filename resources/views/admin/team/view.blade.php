<x-admin-app-layout>
    @section('title') Show Teams @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ $data->name }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="image" class="d-block">Profile Image</label>


                                        @if ($data->image != null)
                                        <img class="mt-3" src="{{ Storage::url($data->image) }}" id="image" alt="your footer_logo" width="130" height="130" style="border:1px dashed black">
                                        @else
                                        <img class="mt-3 d-none" src="" id="image" alt="your footer_logo" width="130" height="130" style="border:1px dashed black">
                                        @endif



                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" id="designation" class="form-control" placeholder="" value="{{ $data->designation }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="3" readonly disabled>{!! $data->description !!}
                                            </textarea required >
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="facebook">Facebook :</label>
                                            <input type="url" class="form-control"
                                                value="{{ $data->facebook }}" name="facebook"
                                                id="facebook" placeholder="Enter facebook" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="twitter">Twitter :</label>
                                            <input type="url" class="form-control"
                                                value="{{ $data->twitter }}" name="twitter"
                                                id="twitter" placeholder="Enter twitter" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="linkedin">Linkedin :</label>
                                            <input type="url" class="form-control"
                                                value="{{ $data->linkedin }}" name="linkedin"
                                                id="linkedin" placeholder="Enter linkedin" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="instagram">Instagram :</label>
                                            <input type="url" class="form-control"
                                                value="{{ $data->instagram }}" name="instagram"
                                                id="instagram" placeholder="Enter instagram" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="pinterest">Pinterest :</label>
                                            <input type="url" class="form-control"
                                                value="{{ $data->pinterest }}" name="pinterest"
                                                id="pinterest" placeholder="Enter pinterest" required readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" disabled>
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

                                <a href="{{ route('admin.our-team.index') }}"
                                class="btn btn-outline-dark custom-btn">Back</a>
                                <a href="{{ route('admin.our-team.edit',$data->id) }}"
                                    class="btn btn-primary ml-3 custom-btn" style="color: white !important;">Edit</a>
                               

                            </div>

                        </div>

                    </div>
                </div>
           
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</x-admin-app-layout>