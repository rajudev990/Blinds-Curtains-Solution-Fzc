<x-admin-app-layout>
    @section('title') Create Project Video @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.project-videos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="title" required>
                                            @error('title')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="description"></textarea>
                                            @error('description')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="video">Project Video</label>
                                            <div class="custom-file">
                                                <input name="video" type="file" class="custom-file-input" id="customFile" 
                                                       onchange="previewVideo(this)">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('video')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>

                                            <video controls muted class="mt-3" id="videoPreview" width="100%">
                                                <source id="videoSource" src="" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="pb-5 pt-3 d-flex justify-content-end">

                                            <a href="{{ route('admin.project-videos.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                            <button class="btn btn-primary ml-3 custom-btn" type="submit">Create</button>

                                        </div>
                                    </div>

                                    <!-- Gloabl Seo -->
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
        @section('script')
    <script>
    function previewVideo(input) {
        const file = input.files[0];
        if (file) {
            const videoSource = document.getElementById('videoSource');
            const videoPreview = document.getElementById('videoPreview');
            videoSource.src = URL.createObjectURL(file);
            videoPreview.load(); // Reload the video element to reflect the new source
        }
    }
</script>
    @endsection
</x-admin-app-layout>