<x-admin-app-layout>
@section('title')
    Show Clients
@endsection
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
                                            <label for="image" class="d-block">Image</label>
                                           

                                            @if ($data->image != null)
                                                <img class="mt-3" src="{{ Storage::url($data->image) }}"
                                                    id="image" alt="your footer_logo" width="250" height="90"
                                                    style="border:1px dashed black">
                                            @else
                                                <img class="mt-3 d-none" src="" id="image"
                                                    alt="your footer_logo" width="250" height="90"
                                                    style="border:1px dashed black">
                                            @endif



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

                                <a href="{{ route('admin.happy-client.index') }}"
                                    class="btn btn-outline-dark custom-btn">Back</a>
                                <a href="{{ route('admin.happy-client.edit',$data->id) }}"
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
