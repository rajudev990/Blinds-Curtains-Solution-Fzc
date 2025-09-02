<x-admin-app-layout>
@section('title') Hero Sections @endsection
@section('css')
@endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('admin.hero-section.update', $data->id) }}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" name="title" id="title" class="form-control" placeholder="" value="{{ $data->title }}" required >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="tag_line">Tag Line</label>
                                            <input type="text" name="tag_line" id="tag_line" class="form-control" placeholder="" value="{{ $data->tag_line }}" required >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"required >{!! $data->description !!}
                                            </textarea  >
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="" value="{{ $data->address }}" required >
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
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

                                <a href="{{ route('admin.hero-section.index') }}"
                                    class="btn btn-outline-dark custom-btn">Cancel</a>
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
