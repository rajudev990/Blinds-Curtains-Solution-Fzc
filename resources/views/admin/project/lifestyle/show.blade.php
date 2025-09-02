<x-admin-app-layout>
    @section('title') Show Life Style Title @endsection

    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('admin.life-style-title.update',$data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Life Style Title</label>
                                            <input disabled value="{{ $data->name }}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
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
                                            <select disabled name="status" id="status" class="form-control">
                                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Deactive</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="pb-5 pt-3 d-flex justify-content-end">
                                            <a href="{{ route('admin.life-style-title.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                            <a href="{{ route('admin.life-style-title.edit',$data->id) }}" class="btn btn-primary ml-3 custom-btn" style="color: white !important;">Edit</a>
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