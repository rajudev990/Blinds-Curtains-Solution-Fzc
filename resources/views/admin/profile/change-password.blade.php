<x-admin-app-layout>
<!-- Main content -->
<section class="content pt-4 pb-4">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title font-weight-bold">Update Password</h1>
                        <br>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                        </p>
                    </div>


                    <form id="quickForm" action="{{ route('admin.password.update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                            @method('put')

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="current_password">Current Password :</label>
                                        <input type="password" name="current_password" class="form-control"
                                            id="current_password" placeholder="Current Password" required>
                                        @error('current_password')
                                        <span role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password">New Password :</label>
                                        <input type="password" name="password" class="form-control"
                                            id="password" placeholder="New Password" required>
                                        @error('password')
                                        <span role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password_confirmation">Password Confirmation :</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" placeholder="password confirmation" required>
                                        @error('password_confirmation')
                                        <span role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 text-right pt-2">
                                    <button type="submit" class="btn btn-primary custom-btn">Update</button>
                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
</x-admin-app-layout>