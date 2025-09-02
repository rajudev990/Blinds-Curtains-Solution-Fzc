<x-admin-app-layout>
@section('title') View Banner @endsection
@section('css')
@endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
           
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="d-block" for="image">Banner Image</label>
                                           
                                            @if ($data->image != null)
                                                <img src="{{ Storage::url($data->image) }}"
                                                    id="image" alt="your footer_logo" width="250" height="150"
                                                    style="border:1px dashed black">
                                            @else
                                                <img src="" id="image"
                                                    alt="your footer_logo" width="250" height="150"
                                                    style="border:1px dashed black">
                                            @endif



                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="banner_link">Banner Link</label>
                                            <input type="url" name="banner_link" id="banner_link"
                                                value="{{ $data->banner_link }}"
                                                class="form-control @error('banner_link') is-invalid @enderror"
                                                placeholder="https://" required readonly>
                                            @error('banner_link')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Banner Status</label>
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

                                <a href="{{ route('admin.banner.index') }}"
                                    class="btn btn-outline-dark custom-btn ">Back</a>
                                <a href="{{ route('admin.banner.edit',$data->id) }}"
                                    class="btn btn-primary ml-3 custom-btn" style="color:white !important">Edit</a>
                                {{-- <button class="btn btn-primary ml-3 custom-btn" type="submit">Update</button> --}}

                            </div>

                        </div>

                    </div>
                </div>
           
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</x-admin-app-layout>
