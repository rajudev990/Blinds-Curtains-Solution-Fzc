<x-admin-app-layout>
    @section('title')
        View Book Page Numbers
    @endsection
    <!-- Main content -->
    @canany(['Catalouge access'])
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.page-numbers.update', $data->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="catalouge_book_id">Catalouge Book Name</label>
                                            <select readonly name="catalouge_book_id" id="catalouge_book_id" class="form-control select2 @error('catalouge_book_id')
                                            is-invalid @enderror" required>
                                                @foreach($book as $item)
                                                <option value="{{ $item->id }}" {{ $data->catalouge_book_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('catalouge_book_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Page Number</label>
                                            <input readonly type="text" name="name" id="name" class="form-control @error('name')
                                            is-invalid @enderror"
                                                placeholder="Page Number" required value="{{ $data->name }}">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select readonly name="status" id="status" class="form-control">
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

                                <a href="{{ route('admin.page-numbers.index') }}"
                                    class="btn btn-outline-dark custom-btn">Cancel</a>
                                
                                    <a href="{{ route('admin.page-numbers.edit',$data->id) }}"
                                    class="btn btn-primary ml-3 custom-btn text-white" style="color: white !Important;">Edit</a>
                          

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
