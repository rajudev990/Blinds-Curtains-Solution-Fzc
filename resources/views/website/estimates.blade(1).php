<x-app-layout>
    @section('title') {{ $selected->title ?? 'Get Estimates' }} @endsection
    @section('css')
    <style>
        .presets-options div {
            cursor: pointer;
        }
    </style>
    @endsection
    
@php
$title = \App\Models\SectionTitle::first();
@endphp
    <main class="main mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="product_single">
                        <div class="wrapper">

                            <div class="big-img">
                                <img src="{{ Storage::url($selected?->image) }}" class="display-img">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="summary-product">
                        {{-- <h1 class="product_title entry-title">{{ $selected->title }}</h1> --}}
                        <h1 class="product_title entry-title text-success">Get estimate</h1>



                        <div class="estimate_feture d-flex justify-content-between">
                            <div class="estimate_main">
                                <div class="from-group">
                                    <label for="">width</label>
                                    <input onchange="calculate()" type="number" id="custom-width" min="50" value="{{ isset($selected->sizes[0]) ? $selected->sizes[0]->width : 0 }}"
                                        class="from-controll">
                                    <span>cm</span>
                                </div>
                                <div class="estimate_icons">x</div>
                                <div class="from-group">
                                    <label for="">Height</label>
                                    <input onchange="calculate()" type="number" id="custom-height" min="50" value="{{ isset($selected->sizes[0]) ? $selected->sizes[0]->height : 0}}"
                                        class="from-controll">
                                    <span>cm</span>
                                </div>
                            </div>
                            <div class="Presets-section">
                                <div class="from-group">
                                    <label for="">Presets</label>
                                    <div class="presets-options">
                                        @foreach($selected->sizes as $size)
                                        <div class="custom-size" data-width="{{ $size->width }}" data-height="{{ $size->height }}" data-price="{{ $size->price }}">{{ $size->width.'X'.$size->height }} </div>

                                        @endforeach

                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="attribute-name mt-3">
                            <p>Style</p>
                        </div>
                        <div class="radio-block-image">
                            <div class="img-selection row mb-4 estimate_new ">
                                @foreach($data as $item)
                                <div class="col-lg-3 col-4 mb-3">
                                    <div class="img-thumbnail estimate {{ $selected?->id == $item->id ? 'selected' : '' }}">
                                        <a href="{{ route('estimates',['product_id'=> $item->id]) }}">
                                            <img src="{{ Storage::url($item->image) }}" width="100%">
                                            <span class="web-form">{{ $item->title }} </span>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- @foreach($selected->sizes as $size)
                        <p class="price">
                            <span class="Price-amount">
                                <bdi>AED {{ $size->price }}</bdi>
                            </span>
                            <span class="Price-dimensions">( {{ $size->width.'cm X '.$size->height.'cm' }} )</span>
                        </p>
                        @endforeach -->

                        <!-- <div class="under-price">
                             <b style="color: red;font-size:30px"> AED <span class="ins-price" id="month-price">{{ $selected->price }}</span>/month</b> ( for 3 months)
                        </div> -->
                        <div class="under-price">
                            <b style="color: red;font-size:30px"> AED <span class="ins-price" id="total-price">{{ isset($selected->sizes[0]) ? $selected->sizes[0]->price * 3 : 0 }} </span>/upfront</b>
                        </div>
                        <div class="under-price">
                            or<b> AED <span class="ins-price"  id="month-price">{{ isset($selected->sizes[0]) ? $selected->sizes[0]->price : 0 }}</span></b> month ( for 3 months)
                        </div>
                        <!-- <div class="under-price">
                             or<b> AED <span class="ins-price" id="total-price">{{ $selected->price * 3 }}</span></b> upfront
                        </div> -->

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
                            <div class="col-lg-4 col-12">
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
                                    <p>{!! $item->description !!}</p>
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
                                    <p>{!! $data->description !!}</p>
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
        var totalPrice = "{{ $selected->sizes[0]->price }}";
        var height = "{{ isset($selected->sizes[0]) ? $selected->sizes[0]->height : 0}}";
        var width = "{{ isset($selected->sizes[0]) ? $selected->sizes[0]->width : 0}}";
        var totalSquare = height * width;
        var perSquare = 0;
        var currentSquare = 0;
        if (totalSquare) {
            perSquare = totalPrice / totalSquare;
        } else {
            perSquare = 0;
        }
        $('.custom-size').click(function() {
            $('#custom-width').val($(this).data("width"));
            $('#custom-height').val($(this).data("height"));
            $('#month-price').text(parseFloat($(this).data("price")));
            $('#total-price').text(parseFloat($(this).data("price") * 3));
            totalPrice = $(this).data("price");
            height = $(this).data("height");
            width = $(this).data("width");
            totalSquare = height * width;
            if (totalSquare) {
                perSquare = totalPrice / totalSquare;
            } else {
                perSquare = 0;
            }
        });

        function calculate() {
            currentSquare = $('#custom-width').val() * $('#custom-height').val();
            $('#month-price').text(parseFloat(currentSquare * perSquare).toFixed(2));
            $('#total-price').text(parseFloat(currentSquare * perSquare * 3).toFixed(2));
        };
    </script>

    <!-- <script>
    var totalPrice = parseFloat("{{ $selected->price }}");
    var height = parseFloat("{{ isset($selected->sizes[0]) ? $selected->sizes[0]->height : 0 }}");
    var width = parseFloat("{{ isset($selected->sizes[0]) ? $selected->sizes[0]->width : 0 }}");
    var totalSquare = height * width;
    var perSquare = totalSquare ? totalPrice / totalSquare : 0;

    $('.custom-size').click(function() {
        width = parseFloat($(this).data("width"));
        height = parseFloat($(this).data("height"));
        totalPrice = parseFloat($(this).data("price"));
        
        totalSquare = height * width;
        perSquare = totalSquare ? totalPrice / totalSquare : 0;

        $('#custom-width').val(width);
        $('#custom-height').val(height);
        $('#month-price').text(totalPrice.toFixed(2));
        $('#total-price').text((totalPrice * 3).toFixed(2));
    });

    function calculate() {
        var currentWidth = parseFloat($('#custom-width').val());
        var currentHeight = parseFloat($('#custom-height').val());
        var currentSquare = currentWidth * currentHeight;
        
        var newMonthPrice = (currentSquare * perSquare).toFixed(2);
        var newTotalPrice = (newMonthPrice * 3).toFixed(2);

        $('#month-price').text(newMonthPrice);
        $('#total-price').text(newTotalPrice);
    }
</script> -->
    @endsection

</x-app-layout>