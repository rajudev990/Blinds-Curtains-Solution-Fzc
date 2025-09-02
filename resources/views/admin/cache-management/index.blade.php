<x-admin-app-layout>

    @section('title') Cache Management @endsection
    @section('css')
    @endsection

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cache Management System</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cache Management System</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                        <a href="{{ route('admin.cache.route_clear') }}" class="btn btn-primary d-block mb-2 p-2">Route Clear</a>
                        <a href="{{  route('admin.cache.view_clear') }}" class="btn btn-success d-block mb-2 p-2">View Clear</a>
                        <a href="{{  route('admin.cache.config_clear') }}" class="btn btn-secondary d-block mb-2 p-2">Clear Config</a>
                        <a href="{{ route('admin.cache.cache_clear') }}" class="btn btn-warning d-block mb-2 p-2">Cache Clear</a>
                        <a href="{{ route('admin.cache.optimize_clear') }}" class="btn btn-dark d-block mb-2 p-2">Optimize Clear</a>
                        <a href="{{ route('admin.cache.storage_link') }}" class="btn btn-danger d-block mb-2 p-2">Storage Link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    @section('script')
    
    @endsection
</x-admin-app-layout>