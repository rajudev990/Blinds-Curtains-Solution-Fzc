<x-admin-app-layout>
    @section('title') Create Project Highlight @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.project-hilights.store') }}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" required>
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
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Description"></textarea>
                                            @error('description')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="type">Project Video Type</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="YouTube">YouTube</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Instagram">Instagram</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="video">Project Video Link</label>
                                        
                                            <input onchange="showVideoPreview(this)" type="text" name="video" id="videoInput" class="form-control @error('video') is-invalid @enderror" placeholder="Video link" required>
                                                @error('video')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                           

                                            <iframe width="100%" height="315" id="videoPreview" class="mt-3 d-none" src="" title="Video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

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
    function showVideoPreview(input) {
        const videoLink = input.value;
        const videoPreview = document.getElementById('videoPreview');
        
        // Assuming the user is providing a valid video link (e.g., YouTube or Vimeo)
        videoPreview.src = videoLink;
        videoPreview.classList.remove('d-none');
        videoPreview.classList.add('d-block');
    }
</script>
    @endsection
</x-admin-app-layout>