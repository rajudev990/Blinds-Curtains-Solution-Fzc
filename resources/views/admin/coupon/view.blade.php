<x-admin-app-layout>
    @section('title')
        View Coupon
    @endsection
    <!-- Main content -->
    @canany(['Coupon access'])
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
                                        <label for="question">Coupon Name</label>
                                        <input type="text" name="name" id="title" class="form-control"
                                            placeholder="Name" required value="{{ $coupon->name }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Coupon Ammount</label>
                                        <input type="number" name="amount" id="title" class="form-control"
                                            placeholder="Ammount" required value="{{ $coupon->amount }}" disabled
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" disabled>
                                            <option {{ $coupon->status == '1' ? 'selected' : '' }} value="1">
                                                Active</option>
                                            <option {{ $coupon->status == '0' ? 'selected' : '' }} value="0">
                                                Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end bg-white pb-5">

                            <a href="{{ route('admin.coupon.index') }}"
                                class="btn btn-outline-dark custom-btn">Cancel</a>

                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                class="btn btn-primary ml-3 custom-btn" style="color: white !important;">Edit</a>

                        </div>

                    </div>

                </div>
            </div>

        </div>
        <!-- /.card -->
    </section>
    @endcan
    <!-- /.content -->
</x-admin-app-layout>
