<!-- Modal -->
<div class="modal fade" id="windowEditModal-{{ $row->id }}">
    <div class="modal-dialog modal-lg">
        <form id="editwindow-form" action="{{ route('admin.item.update', $row->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Window</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">

                     <div class="d-flex form-group mb-0">
                        <input type="checkbox" name="status" id="window_status" value="1" {{ $row->status == '1' ? 'checked' : '' }}>
                        <label class="ml-1 pt-2" for="window_status">Enable</label>
                    </div>
                    <input type="hidden" class="form-control" name="order_type" value="windows">
                    <input type="hidden" class="form-control" name="orderId" value="{{ $order->id }}">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="float-left" for="window_name">Window Name</label>
                                <input type="text" class="form-control" name="window_name" placeholder="Window Name" required value="{{ $row->window_name }}">
                            </div>

                            <div class="form-group">
                                <label class="float-left" for="width">Width</label>
                                <input type="text" class="form-control" id="width" name="width" placeholder="Width" required value="{{ $row->width }}">
                            </div>

                            <div class="form-group">
                                <label class="float-left" for="height_left">Height Left</label>
                                <input type="text" class="form-control" id="height_left" name="height_left" placeholder="Height Left" required value="{{ $row->height_left }}">
                            </div>

                            <div class="form-group">
                                <label class="float-left" for="height_middle">Height Middle</label>
                                <input type="text" class="form-control" id="height_middle" name="height_middle" placeholder="Height Middle" required value="{{ $row->height_middle }}">
                            </div>

                            <div class="form-group">
                                <label class="float-left" for="height_right">Hight Right</label>
                                <input type="text" class="form-control" id="height_right" name="height_right" placeholder="Height Right" required value="{{ $row->height_right }}">
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="float-left" for="fullness">Fullness</label>
                                <select id="fullness" class="form-control select2" name="fullness">
                                    <option value="" disabled selected>Select One</option>
                                    @foreach($fullness as $item)
                                        @if($item->name !== 'Select One')
                                            <option value="{{ $item->name }}" {{ isset($row->fullness) && $row->fullness == $item->name ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="float-left" for="polling">Operation Mode</label>
                                <select id="polling" class="form-control select2" name="polling">
                                    <option value="" disabled selected>Select One</option>
                                    @foreach($polling as $item)
                                        @if($item->name !== 'Select One')
                                            <option value="{{ $item->name }}" {{ isset($row->polling) && $row->polling == $item->name ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                    
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="float-left" for="opening">Opening</label>
                                <select id="opening" class="form-control select2" name="opening">
                                    <option value="" disabled selected>Select One</option>
                                     @foreach($opening as $item)
                                        @if($item->name !== 'Select One')
                                            <option value="{{ $item->name }}" {{ isset($row->opening) && $row->opening == $item->name ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                    
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="float-left" for="location">Location</label>
                                <select id="location" class="form-control select2" name="location">
                                    <option value="" disabled selected>Select One</option>
                                     @foreach($location as $item)
                                        @if($item->name !== 'Select One')
                                            <option value="{{ $item->name }}" {{ isset($row->location) && $row->location == $item->name ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                    
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="float-left" for="lining">Linning</label>
                                <select id="lining" class="form-control select2" name="lining">
                                    <option value="" disabled selected>Select One</option>
                                     @foreach($linning as $item)
                                        @if($item->name !== 'Select One')
                                            <option value="{{ $item->name }}" {{ isset($row->lining) && $row->lining == $item->name ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                    
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label class="float-left" for="comment">Optional Comment</label>
                            <input type="text" class="form-control" name="comment" placeholder="Comment" value="{{ $row->comment }}">
                        </div>

                        <div class="col-6 form-group text-left">
                            <label for="edit_window_product_id">Style</label>
                            <select id="edit_window_product_id" class="form-control select2 edit_window_product_id" name="product_id" required>
                                <option disabled selected>Select</option>
                                @foreach ($styles as $style)
                                <option value="{{ $style->id }}" {{ $row->product_id == $style->id ? 'selected' : '' }}>{{ $style->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        @php
                        // Fetch all product catalogues
                        $productCatalogues = \App\Models\ProductCatalouge::where('product_id', $row->product_id)->get();
                        @endphp

                        <div class="col-lg-12">
                            <div class="edit_catalogue_select_container" id="edit_catalogue_select_container">
                                @foreach ($productCatalogues as $item)
                                
                                @php
                                // Fetch the catalogue books related to the current product catalogue
                                $catalogueBooks = \App\Models\CatalougeBook::where('catalouge_id', $item->catalogue_id)->where('status', 1)->get();
                                @endphp
                                <div class="row">
                                    <!-- Catalogue Dropdown -->
                                    <div class="col-md-3 mb-2 text-left">
                                        <label for="catalogue_{{$item->id}}">Catalogue {{ $loop->iteration }}</label>
                                        <select id="catalogue_{{$item->id}}" class="form-control" name="catalogue_id[]">
                                            <option disabled selected>Select</option>
                                            <option value="{{$item->catalogue->id}}" {{ $item->catalogue_id == $item->catalogue->id ? 'selected' : '' }}>
                                                {{$item->catalogue->name}}
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Catalogue Book Dropdown -->
                                    <div class="col-md-3 mb-2 text-left">
                                        <label for="book_{{$item->id}}">Catalogue Book {{ $loop->iteration }}</label>
                                        <select id="book_{{$item->id}}" class="form-control" name="catalogue_book_id[]">
                                            <option value="">Select Book</option>
                                            @foreach($catalogueBooks as $book)
                                            <option value="{{ $book->id }}"
                                                @foreach($row->catalogueItems as $test)
                                                {{ $book->id == $test->catalogue_book_id ? 'selected' : '' }}
                                                @endforeach
                                                >
                                                {{ $book->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Fetch Pages Based on Each Selected Book -->
                                    @php
                                    // Fetch the selected book ID for the current catalogue item (if available)
                                    $selectedBookId = $row->catalogueItems
                                    ->where('catalogue_id', $item->catalogue_id)
                                    ->pluck('catalogue_book_id')
                                    ->first(); // Get the selected book id for this catalogue

                                    // Fetch the page numbers related to the selected catalogue book
                                    $pages = \App\Models\PageNumber::where('status', 1)
                                    ->where('catalouge_book_id', $selectedBookId)
                                    ->get();
                                    
                                    // Fetch the quantity from the catalogueItems model
                                    $qty = $row->catalogueItems
                                        ->where('catalogue_id', $item->catalogue_id)
                                        ->where('catalogue_book_id', $selectedBookId)
                                        ->pluck('qty')
                                        ->first(); // Get qty for selected book
                                    
                                    
                                    @endphp

                                    <!-- Page Number Dropdown -->
                                    <div class="col-md-3 mb-2 text-left">
                                        <label for="page_{{$item->id}}">Page Number {{ $loop->iteration }}</label>
                                        <select id="page_{{$item->id}}" class="form-control" name="page_number_id[]">
                                            <option value="">Select Pages</option>
                                            @foreach($pages as $page)
                                            <option value="{{ $page->id }}" {{ in_array($page->id, $row->catalogueItems->pluck('page_number_id')->toArray()) ? 'selected' : '' }}>
                                                {{ $page->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                     <!-- Qty Field -->
                                    <div class="col-md-3 mb-2 text-left">
                                        <label for="qty_{{$item->id}}">Qty {{ $loop->iteration }}</label>
                                        <input type="text" id="qty_{{$item->id}}" class="form-control" name="catalouge_qty[]" value="{{ $qty }}" readonly>
                                    </div>
                                    
                                    
                                </div>
                                @endforeach
                            </div>
                        </div>






                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="float-left" for="qty">Fabric Qty (m)</label>
                                <input type="number" class="form-control" name="qty" required value="{{ $row->qty }}">
                            </div>

                            <div class="row">
                                @if($row->images)
                                @foreach(json_decode($row->images) as $image)
                                    <div data-id="{{ $row->id }}" style="position: relative;" class="border border-danger col-lg-5 image-preview p-1 mr-1 mb-2" data-image-name="{{ $image }}">
                                        <img src="{{ asset('uploads/order_items/' . $image) }}" width="100">
                                        <a href="javascript:void(0)" style="position: absolute;right:3px;top:3px;" class="remove-existing-image" data-image-name="{{ $image }}"><i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                @endforeach
                                @endif
                            </div>


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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>
</div>
