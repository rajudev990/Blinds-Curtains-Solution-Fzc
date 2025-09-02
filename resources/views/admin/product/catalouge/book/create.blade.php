<x-admin-app-layout>
    @section('title')
    Create Catalogue Book
    @endsection
    <!-- Main content -->

    @canany(['Catalouge create'])
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.catalogue-books.store') }}" method="post">
                @csrf
                @method('post')
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
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('catalouge_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="question">Book Name</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name')
                                            is-invalid @enderror" placeholder="Book Name" required>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="question">Width (cm)</label>
                                            <input type="number" name="width" id="width" class="form-control @error('width')
                                            is-invalid @enderror" placeholder="width" required>
                                            @error('width')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="number">Supplier Number (whatsapp)</label>
                                            <input type="text" name="number" id="number" class="form-control @error('number')
                                            is-invalid @enderror" placeholder="+970501234567">
                                            @error('number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email">Supplier Email</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email')
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
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end bg-white pb-5">

                                <a href="{{ route('admin.catalogue-books.index') }}"
                                    class="btn btn-outline-dark custom-btn">Cancel</a>
                                <button class="btn btn-primary ml-3 custom-btn" type="submit">Create</button>

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