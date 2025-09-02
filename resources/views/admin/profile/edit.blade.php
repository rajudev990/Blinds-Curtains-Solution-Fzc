<x-admin-app-layout>

    <!-- Main content -->
    <section class="content pt-4 pb-4">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title font-weight-bold">Profile Information</h1>
                        </div>
                        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Name" value="{{ Auth::guard('admin')->user()->name }}">
                                            @error('name')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Email" value="{{ Auth::guard('admin')->user()->email }}">
                                            @error('email')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                placeholder="Phone" value="{{ Auth::guard('admin')->user()->phone }}">
                                            @error('phone')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="image">Profile Image</label>
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input"
                                                    id="customFile" value="{{ Auth::guard('admin')->user()->image }}"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);$('#image').addClass('d-block')">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                @error('image')
                                                <span role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            @if(Auth::guard('admin')->user()->image !=null)
                                            <img class="mt-3" src="{{ Storage::url(Auth::guard('admin')->user()->image) }}"
                                                id="image" alt="your footer_logo" width="50" height="50"
                                                style="border:1px dashed black">
                                            @else
                                            <img class="mt-3 d-none" src="" id="image" alt="your footer_logo"
                                                width="50" height="50" style="border:1px dashed black">
                                            @endif
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
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> -->
</x-admin-app-layout>