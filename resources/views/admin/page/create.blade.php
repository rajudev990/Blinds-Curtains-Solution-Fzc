<x-admin-app-layout>
@section('title') Pages Create @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" required>
                                            @error('title')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="content">Content</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror summernote" name="content" id="content" cols="30" rows="5"></textarea>
                                            @error('content')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                           
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_title">Meta Title (optional)</label>
                                            <input type="text" name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Name">
                                            @error('meta_title')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_description">Meta Description (optional)</label>
                                            <textarea rows="5" cols="3" name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Name"></textarea>
                                            @error('meta_description')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_keywords">Meta Keywords (optional)</label>
                                            <textarea rows="5" cols="3" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Name"></textarea>
                                            @error('meta_keywords')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_image">Meta Image (optional)</label>
                                            <div class="custom-file">
                                                <input name="meta_image" type="file" class="custom-file-input" id="customFile" onchange="document.getElementById('meta_image').src = window.URL.createObjectURL(this.files[0]);$('#meta_image').addClass('d-block')">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('meta_image')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>

                                            <img class="mt-3 d-none" src="" id="meta_image" alt="your footer_logo" width="50" height="50" style="border:1px dashed black">

                                        </div>
                                    </div>

                                    <!-- Gloabl Seo -->



                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
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
                            <div class="card-footer d-flex justify-content-end bg-white pb-5">
                                
                                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                <button class="btn btn-primary ml-3 custom-btn" type="submit">Create</button>
                                
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