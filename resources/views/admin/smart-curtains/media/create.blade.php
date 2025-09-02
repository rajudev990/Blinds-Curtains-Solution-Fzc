<x-admin-app-layout>
@section('title')
    Add New Smart Curtains Media
@endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.smart-curtains-media.store') }}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" name="title" id="title" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="image">Image</label>
                                            <div class="custom-file">
                                                <input required name="image" type="file" class="custom-file-input" id="customFile" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);$('#image').addClass('d-block')">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('image')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>

                                            <img class="mt-3 d-none" src="" id="image" alt="your footer_logo" width="150" height="75" style="border:1px dashed black">

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="short_description">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="5" required></textarea>
                                           
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
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end bg-white pb-5">
                                
                                <a href="{{ route('admin.smart-curtains-media.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
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