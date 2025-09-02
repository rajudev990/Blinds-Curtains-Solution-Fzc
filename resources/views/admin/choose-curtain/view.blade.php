<x-admin-app-layout>
@section('title') Show Choose Curtain @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
           
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="" value="{{ $data->title }}" required readonly>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="7" readonly disabled>{!! $data->description !!}</textarea required >
                                           
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" disabled>
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

                                <a href="{{ route('admin.choose-curtain.index') }}"
                                class="btn btn-outline-dark custom-btn">Back</a>
                                <a href="{{ route('admin.choose-curtain.edit',$data->id) }}"
                                    class="btn btn-primary ml-3 custom-btn" style="color: white !important;">Edit</a>

                            </div>

                        </div>

                    </div>
                </div>
           
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</x-admin-app-layout>
