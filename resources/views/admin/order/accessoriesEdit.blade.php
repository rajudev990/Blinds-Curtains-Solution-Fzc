<!-- Modal -->
<div class="modal fade" id="accessoryEditModal-{{ $row->id }}">
    <div class="modal-dialog">
    <form action="{{ route('admin.item.update', $row->id) }}" method="POST">
                @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Accessories</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 <div class="d-flex form-group mb-0">
                    <input id="editaccessstatus" type="checkbox" name="status" value="1" {{ $row->status == 1 ? 'checked' : '' }}>
                    <label class="ml-1 pt-2" for="editaccessstatus">Enable</label>
                </div>
                <input type="hidden" class="form-control" name="order_type" value="accessories">
                <input type="hidden" class="form-control" name="orderId" value="{{ $order->id }}">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group text-left">
                            <label class="" for="edit_product_id">Accessories</label>
                            <select name="product_id" id="edit_product_id" class="form-control select2" required>
                                @foreach ($accessories as $accessory)
                                    <option {{ $row->product_id == $accessory->id ? 'selected' : '' }} value="{{ $accessory->id }}">{{ $accessory->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group text-left">
                                    <label for="width">Width</label>
                                    <input type="text" class="form-control" required name="width" id="width" value="{{ $row->width }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-left">
                                    <label for="height">Height</label>
                                    <input type="text" class="form-control" required name="height" id="height" value="{{ $row->height }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="float-left" for="description">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Description" value="{{ $row->description }}">
                        </div>

                        <div class="form-group">
                            <label class="float-left" for="qty">Qty</label>
                            <input type="number" class="form-control" name="qty" required value="{{ $row->qty }}">
                        </div>
                    
                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

    </div>
</div>
