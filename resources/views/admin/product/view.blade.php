<x-admin-app-layout>
@section('title') Show Product @endsection
@section('css')
    <style>
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .add__btn {
            width: 60px;
            height: 38px;
            border: 0;
            margin-left: 10px;
            background: green;
            color: #fff;
            border-radius: 6px;
        }

        .remove,
        .real-remove {
            width: 38px;
            height: 38px;
            border: 0;
            margin-left: 18px;
            background: red;
            color: #fff;
            border-radius: 6px;
        }
    </style>
    <style>
        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            font-weight: 500 !important;
            color: #232526 !important;
            text-align: right;
            min-width: 100%;
            transition: all 0.3s ease !important;
            cursor: pointer;
            border: 1px solid;
            border-color: #ced4da;
            border-radius: 4px;
            line-height: 38px;
            font-size: 15px;
            display: flex;
            justify-content: space-between;
            padding: 0;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 100px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close,.upload__img-real-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 5px;
            right: 5px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after,.upload__img-real-close:after {
            content: "✖";
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }

        .upload {
            background: #e9ecef;
            width: 120px;
            text-align: center;
        }
    </style>
    @endsection
    <div class="">
        
        <!-- Main content -->
        <section class="content pt-5">
            <!-- Default box -->
            <div class="container-fluid">
               
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    placeholder="Title" value="{{ $data->title }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="short_description">Short Description</label>
                                                <textarea readonly class="form-control @error('short_description') is-invalid @enderror" name="short_description" cols="30" rows="5" required>{!! $data->short_description !!}</textarea>
                                                @error('short_description')
                                                <div role="alert" class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Gallery Images</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="upload__box">
                                                
                                                <div class="upload__img-wrap">
                                                    @foreach ($data->images as $image)
                                                        <div class="upload__img-box">
                                                            <div style="background-image: url({{ Storage::url($image->gallery_image) }})" class="img-bg">
                                                                {{-- <div class="upload__img-real-close" data-id="{{ $image->id }}"></div> --}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Pricing</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" id="price" class="form-control"
                                                    placeholder="Price" value="{{ $data->price }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <label for="discount">Discount</label>
                                                        <input type="text" name="discount" id="discount"
                                                            class="form-control" placeholder="discount"
                                                            value="{{ $data->discount }}" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="discount"></label>
                                                        <select name="discount_percent" class="form-control mt-2"
                                                            id="" disabled>
                                                            <option value="0"
                                                                {{ $data->discount_percent == '0' ? 'selected' : '' }}>
                                                                Percent</option>
                                                            <option value="1"
                                                                {{ $data->discount_percent == '1' ? 'selected' : '' }}>
                                                                Flat</option>
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center pb-4">
                                        <h2 class="h4 mb-3">Product Variation</h2>
                                        {{-- <div class="">
                                            <button type="button" id="add" class="add__btn">Add +</button>
                                        </div> --}}

                                    </div>
                                    @foreach ($data->sizes as $item)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="size">Size</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select required name="old_size[{{ $item->id }}]"
                                                                id="" class="form-control" disabled>
                                                                <option value="">Select Size</option>
                                                                @foreach ($size as $row)
                                                                    <option value="{{ $row->id }}"
                                                                        {{ $item->size_id == $row->id ? 'selected' : '' }}>
                                                                        {{ $row->width }} X {{ $row->height }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="size_price">Price</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input required type="number"
                                                                name="old_size_price[{{ $item->id }}]"
                                                                id="size_price" class="form-control"
                                                                placeholder="price" value="{{ $item->price }}" readonly>

                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                            {{-- <button data-id="{{ $item->id }}"
                                                class="real-remove nav-icon fas fa-trash-alt"></button> --}}
                                        </div>
                                    @endforeach
                                    {{-- <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div id="items"></div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Inventory</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sku">SKU</label>
                                                <input type="text" name="sku" value="{{ $data->sku }}"
                                                    id="sku" class="form-control" placeholder="sku" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <label for="qty">Quantity</label>
                                                    <input type="number" min="0" name="qty"
                                                        id="qty" value="{{ $data->qty }}"
                                                        class="form-control" placeholder="Qty" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Description</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea class="summernote" name="description" disabled>{!! $data->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control" disabled>
                                            <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>
                                                Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4  mb-3">Product category</h2>
                                    <div class="mb-3">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="category_id" class="form-control" disabled>
                                            <option value="">Select</option>
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ $data->category_id == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Featured product</h2>
                                    <div class="mb-3">
                                        <select name="featured_status" id="featured_status" class="form-control" disabled>
                                            <option value="0"
                                                {{ $data->featured_status == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1"
                                                {{ $data->featured_status == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Featured Image</h2>
                                    <div class="">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="">
                                                    <label for="image" class="d-block">Image</label>
                                                    
                                                    @if ($data->image != null)
                                                        <img class="mt-3" src="{{ Storage::url($data->image) }}"
                                                            id="image" alt="your footer_logo" width="100%"
                                                            height="250" style="border:1px dashed black">
                                                    @else
                                                        <img class="mt-3 d-none" src="" id="image"
                                                            alt="your footer_logo" width="100%" height="250"
                                                            style="border:1px dashed black">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end bg-white pb-5">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-dark custom-btn ">Back</a>
                        <a href="{{ route('admin.product.edit',$data->id) }}" class="btn btn-primary custom-btn ml-3" style="color: white !important;">Edit</a>
                    </div>
                
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <div class='item'>
        <script>
            $(document).ready(() => {
                let template =
                    `<div class='item row'><div class="col-md-6"><div class="mb-3"><div class="row"><div class="col-md-3"><label for="size">Size</label></div><div class="col-md-9"><select required name="size[]" id="" class="form-control"><option value="">Select Size</option>@foreach ($size as $row)<option value="{{ $row->id }}">{{ $row->width }} X  {{ $row->height }}</option>@endforeach</select></div></div></div></div><div class="col-md-4"><div class="mb-3"><div class="row"><div class="col-md-3"><label for="size_price">Price</label></div><div class="col-md-9"><input required type="number" name="size_price[]" id="size_price" class="form-control" placeholder="price"></div></div></div></div><button class="remove nav-icon fas fa-trash-alt"></button></div>`;

                $("#add").on("click", () => {
                    $("#items").append(template);
                })
                $("body").on("click", ".remove", (e) => {
                    $(e.target).parent("div").remove();
                })
                $("body").on("click", ".real-remove", (e) => {
                    $(e.target).parent("div").remove();
                    var id = $(e.target).data('id');
                    $.ajax({
                        type: 'POST',
                        url: "/admin/product/attribute/delete/" + id,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                           
                        }
                    });
                })
            });
        </script>

        <script>
            jQuery(document).ready(function() {
                ImgUpload();
            });

            function ImgUpload() {
                var imgWrap = "";
                var imgArray = [];

                $('.upload__inputfile').each(function() {
                    $(this).on('change', function(e) {
                        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                        var maxLength = $(this).attr('data-max_length');

                        var files = e.target.files;
                        var filesArr = Array.prototype.slice.call(files);
                        var iterator = 0;
                        filesArr.forEach(function(f, index) {

                            if (!f.type.match('image.*')) {
                                return;
                            }

                            if (imgArray.length > maxLength) {
                                return false
                            } else {
                                var len = 0;
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i] !== undefined) {
                                        len++;
                                    }
                                }
                                if (len > maxLength) {
                                    return false;
                                } else {
                                    imgArray.push(f);

                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        var html =
                                            "<div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" + f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                        imgWrap.append(html);
                                        iterator++;
                                    }
                                    reader.readAsDataURL(f);
                                }
                            }
                        });
                    });
                });

                $('body').on('click', ".upload__img-close", function(e) {
                    var file = $(this).parent().data("file");
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i].name === file) {
                            imgArray.splice(i, 1);
                            break;
                        }
                    }
                    $(this).parent().parent().remove();
                });
                $('body').on('click', ".upload__img-real-close", function(e) {
                    var file = $(this).parent().data("file");
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i].name === file) {
                            imgArray.splice(i, 1);
                            break;
                        }
                    }
                    $(this).parent().parent().remove();
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: "/admin/product/image/delete/" + id,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                           
                        }
                    });
                });
            }
        </script>
</x-admin-app-layout>
