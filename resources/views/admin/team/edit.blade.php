<x-admin-app-layout>
    @section('title') Edit Teams @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('admin.our-team.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="name">Name :</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{ $data->name }}" required>
                                            @error('name')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="image">Image :</label>
                                            <div class="custom-file">
                                                <input value="{{ $data->image }}" name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);$('#image').addClass('d-block')">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('image')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                            @if ($data->image != null)
                                            <img class="mt-3" src="{{ Storage::url($data->image) }}" id="image" alt="your footer_logo" width="130" height="130" style="border:1px dashed black">
                                            @else
                                            <img class="mt-3 d-none" src="" id="image" alt="your footer_logo" width="130" height="130" style="border:1px dashed black">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="designation">Designation :</label>
                                            <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" placeholder="" value="{{ $data->designation }}" required>
                                            @error('designation')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="facebook">Facebook :</label>
                                            <input type="url" class="form-control @error('facebook') is-invalid @enderror" value="{{ $data->facebook }}" name="facebook" id="facebook" placeholder="Enter facebook">
                                            @error('facebook')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="twitter">Twitter :</label>
                                            <input type="url" class="form-control @error('twitter') is-invalid @enderror" value="{{ $data->twitter }}" name="twitter" id="twitter" placeholder="Enter twitter">
                                            @error('twitter')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="linkedin">Linkedin :</label>
                                            <input type="url" class="form-control @error('linkedin') is-invalid @enderror" value="{{ $data->linkedin }}" name="linkedin" id="linkedin" placeholder="Enter linkedin">
                                            @error('linkedin')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="instagram">Instagram :</label>
                                            <input type="url" class="form-control @error('instagram') is-invalid @enderror" value="{{ $data->instagram }}" name="instagram" id="instagram" placeholder="Enter instagram">
                                            @error('instagram')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="pinterest">Pinterest :</label>
                                            <input type="url" class="form-control @error('pinterest') is-invalid @enderror" value="{{ $data->pinterest }}" name="pinterest" id="pinterest" placeholder="Enter pinterest">
                                            @error('pinterest')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="3" required>{!! $data->description !!}</textarea>
                                            @error('description')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>
                                                    Deactive
                                                </option>

                                            </select>
                                            @error('status')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-footer d-flex justify-content-end bg-white pb-5">

                                <a href="{{ route('admin.our-team.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
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