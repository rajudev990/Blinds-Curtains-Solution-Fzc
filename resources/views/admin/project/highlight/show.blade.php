<x-admin-app-layout>
    @section('title') Show Project Highlight @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
        <form action="{{ route('admin.project-hilights.update',$data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input readonly value="{{ $data->title }}" type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="title" required>
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
                                            <textarea readonly name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="description">{{ $data->description }}</textarea>
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
                                            <select readonly name="type" id="type" class="form-control">
                                                <option value="YouTube" {{ $data->type == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                                                <option value="Facebook" {{ $data->type == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                                <option value="Instagram" {{ $data->type == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="video" class="d-block">Project Video Link</label>
                                            
                                            <iframe width="100%" height="315" id="videoPreview" class="mt-3" src="{{ $data->video }}" title="Video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                                            

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select readonly name="status" id="status" class="form-control">
                                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Deactive</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="pb-5 pt-3 d-flex justify-content-end">

                                        <a href="{{ route('admin.project-hilights.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                            <a href="{{ route('admin.project-hilights.edit',$data->id) }}" class="btn btn-primary ml-3 custom-btn">Edit</a>

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
</x-admin-app-layout>