<x-admin-app-layout>
    @section('title')
        Update Catalogue Book
    @endsection
    <!-- Main content -->
    @canany(['Catalouge edit'])
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.catalogue-books.update', $data->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-7 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="catalouge_id">Catalouge Name</label>
                                            <select name="catalouge_id" id="catalouge_id" class="form-control select2 @error('catalouge_id')
                                            is-invalid @enderror" required>
                                                @foreach($catalouge as $item)
                                                <option value="{{ $item->id }}" {{ $data->catalouge_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('catalouge_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Book Name</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name')
                                            is-invalid @enderror"
                                                placeholder="Book Name" required value="{{ $data->name }}">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="question">Width (cm)</label>
                                            <input type="number" name="width" id="width" class="form-control @error('width')
                                            is-invalid @enderror"
                                                placeholder="width" required value="{{ $data->width }}">
                                                @error('width')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="number">Supplier Number (whatsapp)</label>
                                            <input value="{{ $data->number }}" type="text" name="number" id="number" class="form-control @error('number')
                                            is-invalid @enderror" placeholder="+970501234567">
                                            @error('number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email">Supplier Email</label>
                                            <input value="{{ $data->email }}" type="email" name="email" id="email" class="form-control @error('email')
                                            is-invalid @enderror" placeholder="jon@gmail.com">
                                            @error('email')
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

                                <a href="{{ route('admin.catalogue-books.index') }}"
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
