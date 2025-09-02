<x-admin-app-layout>
@section('title')
    Add New Go Further
@endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.go-furthers.store') }}" method="post" enctype="multipart/form-data">
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
                                
                                <a href="{{ route('admin.go-furthers.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
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