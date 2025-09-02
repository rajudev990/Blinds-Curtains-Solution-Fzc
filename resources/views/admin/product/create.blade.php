<x-admin-app-layout>
    @section('title') Create Product @endsection
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

        .remove {
            width: 38px;
            height: 38px;
            border: 0;
            margin-left: 18px;
            background: red;
            color: #fff;
            border-radius: 6px;
        }

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

        .upload__img-close {
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

        .upload__img-close:after {
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


    <!-- Main content -->
    <section class="content pt-5">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="validation-form" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" required value="{{ old('title') }}">
                                            @error('title')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="short_description">Short Description</label>
                                            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" cols="30" rows="5" required value="{{ old('short_description') }}"></textarea>
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
                                            <div class="upload__btn-box">
                                                <label class="upload__btn">
                                                    <p class="m-0" style="padding-left: 12px;">Choose file</p>
                                                    <p class="m-0 upload">Browse</p>
                                                    <input type="file" multiple="" class="upload__inputfile @error('gallery_image') is-invalid @enderror" name="gallery_image[]">
                                                    @error('gallery_image')
                                                    <div role="alert" class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </label>
                                            </div>
                                            <div class="upload__img-wrap"></div>
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
                                            <label for="cm_length">CM / Per Piece</label>
                                            <select name="cm_length" class="form-control" id="">
                                                <option value="cm">Per Square Meter</option>
                                                <option value="per piece">Per Piece</option>
                                                <option value="per line meter">Per Line Meter</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cm_length">SKU</label>
                                            <input type="text" name="sku" id="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="sku" value="{{ old('sku') }}">
                                            @error('sku')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price_rate">Price Rate</label>
                                            <input type="number" name="price_rate" id="price_rate" class="form-control price_rate @error('price_rate') is-invalid @enderror" placeholder="Price rate" required value="{{ old('price_rate') }}">
                                            @error('price_rate')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="base_charge">Base Charge</label>
                                            <input type="number" name="base_charge" id="base_charge" class="form-control base_charge @error('base_charge') is-invalid @enderror" placeholder="Base Charge" required value="{{ old('base_charge') }}">
                                            @error('base_charge')
                                            <div role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="additional_charge">Additional Charge</label>
                                            <input type="number" name="additional_charge" id="additional_charge" class="form-control additional_charge @error('additional_charge') is-invalid @enderror" placeholder="Additional Charge" value="{{ old('additional_charge') }}">
                                            @error('additional_charge')
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
                                <div class="d-flex justify-content-between">
                                    <h2 class="h4">Product Variation</h2>
                                    <button type="button" id="add" class="add__btn">Add +</button>
                                </div>
                                <div class="row">

                                    {{-- <div class="col-md-10">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="size">Width</label>
                                                    <input required type="number" name="width[]" id="width" class="form-control width @error('width') is-invalid @enderror" placeholder="price">
                                                    @error('width')
                                                    <div role="alert" class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="size">Height</label>
                                <input required type="number" name="height[]" id="height" class="form-control height @error('height') is-invalid @enderror" placeholder="price">
                                @error('height')
                                <div role="alert" class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="size">Price</label>
                                <input type="number" name="size_price[]" id="size_price" class="form-control size_price @error('size_price') is-invalid @enderror" placeholder="price" readonly="">
                                @error('size_price')
                                <div role="alert" class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>


                        </div>
                    </div>
                </div> --}}


                {{-- <div class="col-md-2">
                                        <label for="size" class="mt-5"></label>
                                        <button type="button" id="add" class="add__btn mt-4">Add +</button>
                                    </div> --}}

                <div class="col-md-12">
                    <div id="items"></div>
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
                            <textarea class="summernote @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"></textarea>
                            @error('description')
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
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="meta_title">Meta Title (optional)</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Name" value="{{ old('meta_title') }}">
                        @error('meta_title')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="meta_description">Meta Description (optional)</label>
                        <textarea rows="5" cols="3" name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Name" value="{{ old('meta_description') }}"></textarea>
                        @error('meta_description')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="meta_keywords">Meta Keywords (optional)</label>
                        <textarea rows="5" cols="3" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Name" value="{{ old('meta_keywords') }}"></textarea>
                        @error('meta_keywords')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="meta_image">Meta Image (optional)</label>
                        <div class="custom-file">
                            <input name="meta_image" type="file" class="custom-file-input" id="customFile" onchange="document.getElementById('meta_image').src = window.URL.createObjectURL(this.files[0]);$('#meta_image').addClass('d-block')">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @error('meta_image')
                            <div role="alert" class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <img class="mt-3 d-none" src="" id="meta_image" alt="your footer_logo" width="50" height="50" style="border:1px dashed black">

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
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        @error('status')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Smart Curtains status</h2>
                    <div class="mb-3">
                        <select name="smart_curtains" id="smart_curtains" class="form-control @error('smart_curtains') is-invalid @enderror">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        @error('smart_curtains')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            
            
            <div class="card">
                <div class="card-body">
                    <h2 class="h4  mb-3">Product category</h2>
                    <div class="mb-3">
                        <select onChange="category();" name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">Select</option>
                            @foreach ($category as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->name }}
                            </option>
                            @endforeach

                        </select>
                        @error('category_id')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                </div>
            </div>
            
            <div class="card d-none supplier">
                <div class="card-body">
                    <h2 class="h4  mb-3">Supplier Info</h2>
                    <div class="mb-3">
                        <label>Supplier Number (whatsapp)</label>
                        <input type="text" name="number" id="number" class="form-control @error('number') is-invalid @enderror" placeholder="+971501234567" />
                        @error('number')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Supplier Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="jon@gmail.com" />
                        @error('email')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                </div>
            </div>


            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Bestsellers Status</h2>
                    <div class="mb-3">
                        <select name="featured_status" id="featured_status" class="form-control @error('featured_status') is-invalid @enderror">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        @error('featured_status')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Get Estimate Status</h2>
                    <div class="mb-3">
                        <select name="estimate_status" id="estimate_status" class="form-control @error('estimate_status') is-invalid @enderror">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        @error('estimate_status')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <h2 class="h4 mb-3">Product Serial For Estimate</h2>
                        <input type="number" name="serial_number" class="form-control">
                        @error('serial_number')
                            <div role="alert" class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                                    
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Featured Image</h2>
                    <div class="">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input required name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);$('#image').addClass('d-block')">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @error('image')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <img class="mt-3 d-none" src="" id="image" alt="your footer_logo" width="100%" height="250" style="border:1px dashed black">

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Catalogue</h2>
                    <div class="mb-3">
                        <select class="select2" multiple="multiple" data-placeholder="Select Catalogue" data-dropdown-css-class="select2-purple" style="width: 100%;" name="catalogue_id[]" id="catalogue_id" class="select2 form-control @error('catalogue_id') is-invalid @enderror">
                            @foreach($catalouge as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('catalogue_id')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                                    
                </div>
            </div>
            
            
             <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Style</h2>
                    <div class="mb-3">
                        <select name="style" id="style" class="form-control @error('style') is-invalid @enderror">
                            <option value="">Select Style</option>
                            <option value="Wave Style">Wave Style</option>
                            <option value="American Style">American Style</option>
                            <option value="Roman Blinds">Roman Blinds</option>
                        </select>
                        @error('style')
                        <div role="alert" class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                                    
                </div>
            </div>
            
            
            
        </div>
        </div>

        <div class="card-footer d-flex justify-content-end bg-white pb-5">
            <a href="{{ route('admin.product.index') }}" class="btn btn-outline-dark custom-btn ">Cancel</a>
            <button class="btn btn-primary custom-btn ml-3">Create</button>
        </div>
        </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <div class='item'>
        <script>
            $(document).ready(() => {
                let template =
                    `<div class='item row'>
                    <div class="col-md-10">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="width">Width</label>
                                    <input required type="number" name="width[]" id="width" class="form-control width @error('width')is-invalid @enderror" placeholder="Width">
                                    @error('width')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="height">Height</label>
                                    <input required type="number" name="height[]" id="height" class="form-control height @error('height') is-invalid @enderror" placeholder="Height">
                                    @error('height')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="size_price">Price</label>
                                    <input type="number" name="size_price[]" id="size_price" class="form-control size_price @error('size_price') is-invalid @enderror" placeholder="Price" readonly="">
                                    @error('size_price')
                                    <div role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="size" class="mt-5"></label>
                        <button class="remove nav-icon fas fa-trash-alt mt-4"></button>
                    </div>
                </div>`;

                $("#add").on("click", () => {
                    $("#items").append(template);
                });

                $("body").on("click", ".remove", (e) => {
                    $(e.target).closest(".item").remove();
                });

                // Function to calculate price
                function calculatePrice($item) {
                    let width = parseFloat($item.find('.width').val()) || 0;
                    let height = parseFloat($item.find('.height').val()) || 0;
                    let price_rate = parseFloat($('#price_rate').val()) || 0;
                    let base_charge = parseFloat($('#base_charge').val()) || 0;
                    let additional_charge = parseFloat($('#additional_charge').val()) || 0;
                    let price = 0;

                    let area = (width * height) / 10000;
                    let persqr = area * price_rate;
                    let additionalCharge = 0;

                    if (width > 280 && height > 260) {
                        additionalCharge = area * additional_charge;
                        price = (persqr + base_charge + additionalCharge) / 3;
                    } else {

                        price = (persqr + base_charge) / 3;
                    }

                    $item.find('.size_price').val(price.toFixed(2));
                }

                // Trigger calculations on input changes
                $("body").on("input", ".width, .height", function() {
                    let $item = $(this).closest('.item');
                    calculatePrice($item);
                });

                $("#price_rate, #base_charge, #additional_charge").on("input", function() {
                    $(".item").each(function() {
                        calculatePrice($(this));
                    });
                });

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
                                        var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
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
            }
        </script>
        <script>
            function category() {
 
                const selectedValue = document.getElementById("category_id").value;
                const supplierDiv = document.querySelector(".supplier");
        
                if (selectedValue === "4") {
                    supplierDiv.classList.remove("d-none"); // Show the div
                } else {
                    supplierDiv.classList.add("d-none"); // Hide the div
                }
            }
        </script>

</x-admin-app-layout>