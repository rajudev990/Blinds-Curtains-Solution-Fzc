<!-- Modal -->
<div class="modal fade" id="windowModal">
    <div class="modal-dialog modal-lg">
        <form id="window-form" action="{{ route('admin.item.create', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Window</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                     <div class="form-group">
                        <input type="checkbox" name="status" id="status" value="1">
                        <label for="status">Enable</label>
                    </div>
                    <input type="hidden" name="order_type" value="windows">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="window_name">Window Name</label>
                                <input type="text" class="form-control" name="window_name" placeholder="Window Name" required>
                            </div>

                            <div class="form-group">
                                <label for="width">Width</label>
                                <input type="text" class="form-control" id="width" name="width" placeholder="Width" required>
                            </div>

                            <div class="form-group">
                                <label for="height_left">Height Left</label>
                                <input type="text" class="form-control" id="height_left" name="height_left" placeholder="Height Left" required>
                            </div>

                            <div class="form-group">
                                <label for="height_middle">Height Middle</label>
                                <input type="text" class="form-control" id="height_middle" name="height_middle" placeholder="Height Middle" required>
                            </div>

                            <div class="form-group">
                                <label for="height_right">Hight Right</label>
                                <input type="text" class="form-control" id="height_right" name="height_right" placeholder="Height Right" required>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="fullness">Fullness</label>
                                <select id="fullness" class="form-control select2" name="fullness">
                                    @foreach($fullness as $item)
                                    <option value="{{ $item->name }}"  @if($item->name == 'Select One') selected disabled @endif>{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="polling">Operation Mode</label>
                                <select id="polling" class="form-control select2" name="polling">
                                    @foreach($polling as $item)
                                    <option value="{{ $item->name }}" @if($item->name == 'Select One') selected disabled @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="opening">Opening</label>
                                <select id="opening" class="form-control select2" name="opening">
                                    @foreach($opening as $item)
                                    <option value="{{ $item->name }}" @if($item->name == 'Select One') selected disabled @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select id="location" class="form-control select2" name="location">
                                    @foreach($location as $item)
                                    <option value="{{ $item->name }}" @if($item->name == 'Select One') selected disabled @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lining">Linning</label>
                                <select id="lining" class="form-control select2" name="lining">
                                    @foreach($linning as $item)
                                    <option value="{{ $item->name }}" @if($item->name == 'Select One') selected disabled @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="comment">Optional Comment</label>
                            <input type="text" class="form-control" name="comment" placeholder="Comment">
                        </div>


                        <div class="form-group col-6">
                            <label for="window_product_id">Style</label>
                            <select id="window_product_id" class="form-control select2 window_product_id edit_window_product_id" name="product_id" required>
                                <option disabled selected>Select</option>
                                @foreach ($styles as $style)
                                <option value="{{ $style->id }}">{{ $style->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Placeholder for dynamic catalogue selects -->
                        <div class="col-lg-12">
                            <div class="catalogue_select_container" id="catalogue_select_container"></div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-lg-6">
                            <label for="qty">Fabric Qty (m)</label>
                            <input type="number" class="form-control" name="qty" required value="1">
                        </div>
                        <div class="col-lg-6">
                            <div class="text-right">
                                <button type="button" id="add-more-images" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                            <div id="image-upload-section">
                                <div class="image-group d-flex mb-2">
                                    <input type="file" name="images[]" class="image-input form-control p-1" style="border-radius: 0px !important;">
                                    <button type="button" class="remove-image btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
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
