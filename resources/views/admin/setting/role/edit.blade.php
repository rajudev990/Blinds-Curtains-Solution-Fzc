<x-admin-app-layout>
    @section('title') Updated Roles @endsection
    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.roles.update',$role->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Role Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="role_name" name="name" placeholder="Role Name" value="{{ old('name',$role->name) }}">
                                            @error('name')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            @foreach ($permissions as $permission)
                                            <div class="col-md-3 mb-1">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]" @if(count($role->permissions->where('id',$permission->id))) checked @endif>
                                                        <label for="customCheckbox{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-dark custom-btn">Cancel</a>
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