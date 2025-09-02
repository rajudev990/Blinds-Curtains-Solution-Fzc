<!-- Modal -->
<div class="modal fade" id="AacessoriesModal">
    <div class="modal-dialog">
    <form id="accessories-form" action="{{ route('admin.item.create', $order->id) }}" method="POST">
                @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Accessories</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 <div class="form-group">
                    <input id="addaccessstatus" type="checkbox" name="status" value="1">
                    <label for="addaccessstatus">Enable</label>
                </div>
                <input type="hidden" class="form-control" name="order_type" value="accessories">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="product_id">Accessories</label>
                            <select name="product_id" id="product_id" class="form-control select2" required>
                                <option disabled selected>Select</option>
                                @foreach ($accessories as $accessory)
                                    <option value="{{ $accessory->id }}">{{ $accessory->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group text-left">
                                    <label for="width">Width</label>
                                    <input type="text" class="form-control" required name="width" id="width">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-left">
                                    <label for="height">Height</label>
                                    <input type="text" class="form-control" required name="height" id="height">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Description">
                        </div>

                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" class="form-control" name="qty" required value="1">
                        </div>
                    
                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

    </div>
</div>
