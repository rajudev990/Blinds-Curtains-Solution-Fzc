<x-app-layout>
    @section('title') {{ $selected->title ?? 'Get Estimates' }} @endsection
    @section('css')
    <style>
        .presets-options div {
            cursor: pointer;
        }
        @media(max-width:576px)
        {
            .estimate_main{
                width:100%;
            }
            .presets-options{
                display:flex;
            }
        }
    </style>
    @endsection
    
@php

$title = \App\Models\SectionTitle::first();

$data = \App\Models\Product::orderBy('serial_number', 'asc')
    ->with('sizes')
    ->where('estimate_status', 1)
    ->whereStatus(1)
    ->get();
$firstProduct = $data->first();
@endphp
    <main class="main mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="product_single">
                        <div class="wrapper">
                            <div class="big-img">
                                <img src="{{ Storage::url($firstProduct?->image) }}" class="display-img" id="product-image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="summary-product">
                        <h1 class="product_title entry-title text-success">Get estimate</h1>


                        <div class="d-lg-flex estimate_feture justify-content-lg-around d-md-flex justify-content-md-around">
                            <div class="estimate_main">
                                <div class="form-group">
                                    <label for="">Width</label>
                                    <div class="input-group">
                                        <input type="number" id="custom-width" min="100" value="200" class="form-control" style="padding-right:10px !important;width:60% !important;border-top-right-radius: 0px !important;border-bottom-right-radius: 0px !important;">
                                        <span class="input-group-text" style="background-color: #fbf7f3;">cm</span>
                                    </div>
                                </div>
                                <div class="estimate_icons">x</div>
                                <div class="form-group">
                                    <label for="">Height</label>
                                    <div class="input-group">
                                        <input type="number" id="custom-height" min="100" value="300" class="form-control" style="padding-right:10px !important;width:60% !important;border-bottom-right-radius: 0px !important;border-top-right-radius: 0px !important;">
                                        <span class="input-group-text" style="background-color: #fbf7f3;">cm</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="Presets-section">
                                <div class="from-group">
                                    <label for="">Presets</label>
                                    <div class="presets-options" id="preset-sizes">
                                        @foreach($firstProduct->sizes as $size)
                                            <div class="custom-size" data-width="{{ $size?->width }}" data-height="{{ $size?->height }}" data-price="{{ $size?->price }}">
                                                {{ $size?->width.'X'.$size?->height }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                        <div class="attribute-name mt-3">
                            <p>Style</p>
                        </div>
                        
                        <div class="radio-block-image">
                            <div class="img-selection row mb-4 estimate_new">
                                @foreach($data as $item)
                                    <div class="col-lg-3 col-4 mb-3">
                                        <div class="img-thumbnail estimate">
                                            <a href="javascript:void(0)" class="product-selection" data-image="{{ Storage::url($item?->image) }}" data-price_rate="{{ $item->price_rate }}" data-base_charge="{{ $item->base_charge }}" data-additional_charge="{{ $item->additional_charge }}" data-sizes="{{ json_encode($item->sizes) }}">
                                                <img src="{{ Storage::url($item?->image) }}" width="100%">
                                                <span class="web-form">{{ $item->title }} </span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        
                        <div class="under-price">
                            <b style="color: red;font-size:30px"> AED <span class="ins-price" id="total-price">0.00</span>/upfront</b>
                        </div>
                        <div class="under-price">
                            or<b> AED <span class="ins-price" id="month-price">0.00</span></b> month ( for 3 months)
                        </div>
            
                        <div class="product-details__short-description mt-3">
                            <p>*The displayed price is for the base offer; for upgraded options prices may vary (e.g., premium sheer, wavy curtains, automation). Book a visit to have your custom quotation!</p>
                        </div>
            
                        <div class="mt-3">
                            <a href="{{ route('book') }}" class="btn-get-started" style="width: 100%;">BOOK A FREE VISIT</a>
                        </div>
                      

                       
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <section id="services" class="services section light-background pt-3 mt-4">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ $title->next_section_title }}</h2>
                    <p>{{ $title->next_section_description }}</p>
                </div><!-- End Section Title -->

                <div class="container">

                    <div class="row gy-4">
                        @foreach($service as $item)


                        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item position-relative p-0">
                                <div class="icon"><img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}"></div>
                                <div class="p-2">
                                    <h4><a href="{{ route('book') }}" class="stretched-link">{{ $item->title }}</a></h4>
                                    <p>{!! Str::limit($item->short_description,40,'...') !!}</p>
                                    <div class="text-center">
                                        <a href="{{ route('book') }}" class="btn-get-started mt-3 mb-2">Book a free visit</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Service Item -->
                        @endforeach
                    </div>

                </div>

            </section><!-- /Services Section -->

            <div class="mt-5 mb-5">
                <div class="container">
                    <div class="general-guides-container">
                        <div class="headding_general">
                            <h2>{{ $title->getestimate_section_title_one }}</h2>
                        </div>
                        <div class="general-guides-tabs">
                            <div class="tabs_main">
                                <div class="tabs__guides">
                                    @php
                                    $list = \App\Models\GetEstimateTitle::where('status',1)->get();
                                    @endphp
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach($list as $index => $item)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if($index === 0) active @endif" id="tab-{{ $index }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#tab-{{ $index }}" type="button" role="tab"
                                                    aria-controls="tab-{{ $index }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                    {{ $item->name }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="tab-content" id="myTabContent">
                            @foreach($list as $index => $item)
                                <div class="tab-pane fade @if($index === 0) show active @endif" id="tab-{{ $index }}" role="tabpanel"
                                    aria-labelledby="tab-{{ $index }}-tab">
                        
                                    @foreach ($item->estimates as $life)
                                        <div class="row mt-5 mb-3">
                                            <div class="col-lg-6 col-12 tabls_img">
                                                <img src="{{ Storage::url($life->image) }}" alt="">
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="tabls_img-content">
                                                    <h3 class="tabls_img-title mb-3">{{ $life->title }}</h3>
                                                    <span class="tabls_img-body mb-3 d-block">
                                                        <p style="text-align: left;">{{ $life->description }}</p>
                                                    </span>
                                                    <a href="{{ route('book') }}" class="btn-get-started mt-3">
                                                        Book a free visit
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                        
                                </div>
                            @endforeach
                        </div>

                            
                           
                        </div>

                    </div>

                </div>
            </div>

            <div class="how-to-choose-your-curtains-container">
                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h2 class="product_main__heading">{{ $title->getestimate_section_title_two }}</h2>
                        </div>
                        
                        
                        <div class="row">
                            @foreach($choose as $data)
                            <div class="col-lg-4 col-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 style="color:#053669;font-weight: bold;">{{ $data->title }}</h5>
                                        <p style="font-size:15px;text-align:justify;">{{ Str::limit($data->description,150, '...') }}</p>
                                        <a href="{{ route('book') }}" class="btn-get-started">
                                            Book a Free Visit
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        
                        
                    </div>

                </div>
                
            </div>


            <div class="different-product mt-5">
                <h2 class="product_main__heading">{{ $title->getestimate_section_title_three }}</h2>
                <div class="row">
                    @foreach($ourBlog as $item)
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="different-service">
                            <img src="{{ Storage::url($item->image) }}" alt="">
                            <div class="service-text p-3">
                                <div class="pricing-product-single">
                                    <h3> {{ $item->title }}</h3>
                                </div>
                                <div class="" style="min-height: 104px;">
                                    <p>
                                        {!! Str::limit($item->description, 150, '...') !!}
                                        @if(strlen($item->description) > 150)
                                            <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                                        @endif
                                    </p>
                                    <p class="full-description" style="display: none;">
                                        {!! $item->description !!}
                                        <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
           
        </div>

        <div class="container mb-5">
            <div class="different-cutrain-materials-container ">
                <div class="col-md-12">
                    <div class="different-cutrain-materials-header web-titles-II text-center">
                        <h2 class="text-success">{{ $title->getestimate_section_title_four }}</h2>
                    </div>
                    <div class="different-cutrain-materials-body">
                        @foreach($different as $data)


                        <div class="different-cutrain-material">
                            <div class="different-cutrain-material-image">
                                <img src="{{ Storage::url($data->image) }}" alt="">
                                <div class="different-cutrain-material-title web-taglines">
                                    <h6>{{ $data->title }}</h6>
                                </div>
                            </div>
                            <div class="different-cutrain-material-text">
                                <div class="different-cutrain-material-subtitle web-body">
                                    
                                    <p>
                                        {!! Str::limit($data->description, 80, '...') !!}
                                        @if(strlen($data->description) > 80)
                                            <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                                        @endif
                                    </p>
                                    <p class="full-description" style="display: none;">
                                        {!! $data->description !!}
                                        <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

    </main>

    @section('script')
     <script>
        $(document).ready(function () {
            function calculatePrice(width, height, price_rate, base_charge, additiona_charge) {
                let area = (width * height) / 10000;
                let additional_charge = (width > 280 && height > 260) ? area * additiona_charge : 0;
                let total_price = area * price_rate + base_charge + additional_charge;
                return {
                    total: total_price,
                    monthly: total_price / 3
                };
            }
        
            function updatePrice() {
                let width = parseFloat($('#custom-width').val());
                let height = parseFloat($('#custom-height').val());
                let price_rate = parseFloat($('.product-selection.active').data('price_rate'));
                let base_charge = parseFloat($('.product-selection.active').data('base_charge'));
                let additional_charge = parseFloat($('.product-selection.active').data('additional_charge'));
        
                // Check if width and height are valid numbers
                if (!isNaN(width) && !isNaN(height) && price_rate && base_charge && additional_charge) {
                    let prices = calculatePrice(width, height, price_rate, base_charge, additional_charge);
                    $('#total-price').text(prices.total.toFixed(2));
                    $('#month-price').text(prices.monthly.toFixed(2));
                } else {
                    $('#total-price').text('0.00');
                    $('#month-price').text('0.00');
                }
            }
        
            $('#custom-width, #custom-height').on('input', function () {
                updatePrice();
            });
        
            $('.custom-size').on('click', function () {
                let width = $(this).data('width');
                let height = $(this).data('height');
        
                $('#custom-width').val(width);
                $('#custom-height').val(height);
        
                updatePrice();
            });
        
            $('.product-selection').on('click', function () {
                let image = $(this).data('image');
                let price_rate = $(this).data('price_rate');
                let base_charge = $(this).data('base_charge');
                let additional_charge = $(this).data('additional_charge');
                let sizes = $(this).data('sizes');
        
                $('.product-selection').removeClass('active');
                $(this).addClass('active');
        
                $('#product-image').attr('src', image);
        
                // Update the sizes in the preset section
                let presetSizesContainer = $('#preset-sizes');
                presetSizesContainer.empty();
                sizes.forEach(function(size) {
                    presetSizesContainer.append(
                        `<div class="custom-size" data-width="${size.width}" data-height="${size.height}" data-price="${size.price}">
                            ${size.width}X${size.height}
                        </div>`
                    );
                });
        
                // Rebind the click event to the newly added size options
                $('.custom-size').on('click', function () {
                    let width = $(this).data('width');
                    let height = $(this).data('height');
        
                    $('#custom-width').val(width);
                    $('#custom-height').val(height);
        
                    updatePrice();
                });
        
                updatePrice();
            });
        
            // Trigger the first calculation
            $('.product-selection').first().trigger('click');
        });
    </script>
    <script>
    $(document).ready(function(){
        $('.see-more').click(function(){
            $(this).parent().hide(); // Hide the limited description
            $(this).parent().next('.full-description').show(); // Show the full description
        });

        $('.see-less').click(function(){
            $(this).parent().hide(); // Hide the full description
            $(this).parent().prev().show(); // Show the limited description
        });
    });
</script>
    
    @endsection

</x-app-layout>