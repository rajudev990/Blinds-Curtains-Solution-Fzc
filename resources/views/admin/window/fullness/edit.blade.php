<x-admin-app-layout>
    @section('title')
        Update FullNess
    @endsection
    <!-- Main content -->
    @canany(['FullNess edit'])
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.fullness.update', $data->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="question">Name</label>
                                            <input type="text" name="name" id="title" class="form-control @error('name')
                                            is-invalid @enderror"
                                                placeholder="Name" required value="{{ $data->name }}">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option {{ $data->status == '1' ? 'selected' : '' }} value="1">
                                                    Active</option>
                                                <option {{ $data->status == '0' ? 'selected' : '' }} value="0">
                                                    Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end bg-white pb-5">

                                <a href="{{ route('admin.fullness.index') }}"
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
    @endcan
    <!-- /.content -->
</x-admin-app-layout>
