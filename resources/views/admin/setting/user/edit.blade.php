<x-admin-app-layout>
    @section('title') Update Staff @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.users.update',$user->id)}}">
                @csrf
                @method('put')
                <div class="row">

                    <div class="col-lg-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="name" class="mb-0">User Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                placeholder="Enter Name" value="{{ old('name',$user->name) }}">
                                            @error('name')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="email" class="mb-0">User Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                placeholder="Enter email" value="{{ old('email',$user->email) }}">
                                            @error('email')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="password" class="mb-0">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                                placeholder="Enter Password" value="{{ old('password') }}">
                                            @error('password')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="password_confirmation" class="mb-0">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                                name="password_confirmation" placeholder="Re-enter password">
                                            @error('password_confirmation')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="roles" class="mb-0">Assign Roles <span class="text-danger">*</span></label>
                                                <select name="roles[]" id="roles" class="form-control select2 @error('roles') is-invalid @enderror" multiple>
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->id}}" {{ count($user->roles->where('id',$role->id)) ? 'selected':'' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('roles')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
                                            <button class="btn btn-primary ml-3 custom-btn" type="submit">Update</button>
                                        </div>
                                    </div>

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