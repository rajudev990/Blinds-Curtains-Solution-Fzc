<x-admin-app-layout>
    @section('title') Create Help Title @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.help-title.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Help Title Name</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>
                                            @error('name')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
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

                                            <a href="{{ route('admin.help-title.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
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
</x-admin-app-layout>