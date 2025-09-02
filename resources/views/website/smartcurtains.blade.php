<x-app-layout>
    @section('title') Smart Curtains @endsection
    <main class="main">
        <div class="smart__section">
            <div class="smart__image">

                <img src="{{ Storage::url($page->banner_image) }}" alt="">
                <div class="smart_banner_content">
                    <div class="banner-image-box">
                        <h1 class="banner-image-title">{{ $page->banner_title }}</h1>
                    </div>
                </div>

            </div>
            <div class="nav-bar-wrapper ">
                <nav class="nav-bar ">

                    <ul>
                        <li><a class="nav-bar-btn " href="#step1">Curtains
                                types</a></li>

                        <li><a class="nav-bar-btn" href="#step2">Electric
                                curtains</a></li>

                        <li><a class="nav-bar-btn" href="#step3">Control mode</a>
                        </li>

                        <li><a class="nav-bar-btn" href="#step4">Complementary
                                accessories</a></li>

                        <li><a class="nav-bar-btn" href="#step5">Installation</a>
                        </li>

                    </ul>

                </nav>
            </div>

            <div class="smart__description">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <p>{!! $page->banner_description !!}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <section class="content-with-html ">
            <div class="container">

                <div class="row">
                    <div class=" col-lg-9 col-12">

                        <h2 class="content-with-html-title ">{{ $page->title }}</h2>
                        <div class="content-with-html-content ">
                            <p>{!! $page->title_description !!}</p>

                            <div class="">
                                {!! $page->title_text !!}

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="step1" class="services section light-background smart_main_service">

            <!-- Section Title -->
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h2>{{ $page->step_one_title }}</h2>
                <p>{{ $page->step_one_description }}</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-6 col-md-6 d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative smart_service">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="javascript:void(0)" class="stretched-link">{{ $page->step_one_title_one }}</a></h4>
                            <p>{{ $page->step_one_title_one_description }}</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-6 col-md-6 d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative smart_service">
                            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                            <h4><a href="javascript:void(0)" class="stretched-link">{{ $page->step_one_title_two }}</a></h4>
                            <p>{{ $page->step_one_title_two_description }}</p>
                        </div>
                    </div><!-- End Service Item -->



                </div>

            </div>

        </section>
        <section id="step2" style="background: #fffaf8;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <div class="faq__body p-4">
                            <div class="main-faq">
                                <p>{{ $page->step_two_description }}</p>
                                <h2 class="support-presentation-title">
                                    {{ $page->step_two_title }}
                                </h2>
                            </div>
                            <div class="accordion" id="accordionPanelsStayOpenExample">

                                @foreach ($electrics as $index => $item)
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="panelsStayOpen-{{ $index }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen--{{ $index }}"
                                            aria-expanded="false" aria-controls="panelsStayOpen--{{ $index }}">
                                            {{ $item->title }}
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen--{{ $index }}" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-{{ $index }}" style="">
                                        <div class="accordion-body">
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5 col-12" style="max-height:385px;">
                        <img style="height: 100%;border-radius: 8px;" src="{{ Storage::url($page->step_two_image) }}" alt="">
                    </div>
                </div>
            </div>

        </section>

        <section id="step3">
            <div class="container">
                <div class="general-guides-container" style="background: transparent;">
                    <div class="headding_general">
                        <h2 class="p-0">
                            {{ $page->step_three_title }}
                        </h2>
                        <p class="text-center">{{ $page->step_three_description }}</p>
                    </div>
                    <div class="general-guides-tabs">
                        <div class="tabs_main">
                            <div class="tabs__guides">
                                @php
                                $list = \App\Models\LifeStyleTitle::where('status',1)->get();
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

                                @foreach ($item->lifes as $life)
                                <div class="row mt-5 mb-3">
                                    <div class="col-lg-6 col-12 tabls_img">
                                        <img class="border" src="{{ Storage::url($life->image) }}" alt="">
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
        </section>
        <section id="step4" class="p-0">
            <div class="get-estimates-home pt-5 pb-5">
                <div class="container">
                    <div class="services-container">
                        <div class="">
                            <div class="services-header text-center mb-5">
                                <h2>{{ $page->step_four_title }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        
                        @php
                            $data = \App\Models\Product::where('smart_curtains','1')->where('status','1')->latest()->get();
                        @endphp
                        @foreach($data as $product)
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="get-estimates-home-product">
                                <div class="image_box">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}">
                                </div>
                                <div class="service-text">
                                    <div class="mb-3">
                                        <!--<a href="{{ route('estimates', ['product_id' => $product->id]) }}">-->
                                         <a href="{{ route('product', $product->id) }}">
                                            <strong class="fs-4" style="font-size:16px !important;">{{ $product->title }} </strong>
                                        </a>
                                    </div>
                                    <div class="">
                                        <!--<p style="text-align: justify;">{{ Str::limit($product->short_description,'60','...') }}</p>-->
                                        
                                            <p>
                                                {!! Str::limit($product->short_description, 20, '...') !!}
                                                @if(strlen($product->short_description) > 20)
                                                    <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                                                @endif
                                            </p>
                                            <p class="full-description" style="display: none;">
                                                {!! $product->short_description !!}
                                                <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                                            </p>
                                        
                                        
                                        <a href="{{ route('product', $product->id) }}" class="btn-get-started mb-2 pb-2"
                                            style="width: 100%;border-radius: 2rem;">Find out more </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                       

                    </div>

                </div>
            </div>
        </section>
        <section id="step5" class="content-with-html " style="background: #fbf7f3;">
            <div class="container">

                <div class="row">
                    <div class=" col-lg-9 col-12">

                        <h2 class="content-with-html-title ">{{ $page->step_five_title }} </h2>
                        <div class="content-with-html-content ">
                            <p>{{ $page->step_five_description }}</p>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--<section id="contact" class="contact section">
            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 ">
                    <div class="col-lg-6 col-12">
                        <img style="height: 100%;border-radius: 8px;" src="{{ asset('frontend/assets') }}/img/Duaa-home-.jpg" alt="">
        </div>
        <div class="col-lg-6 col-12">
            <form action="forms/contact.php" method="post" class="php-email-form aos-init aos-animate"
                data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <label for="city1" class="pb-2">Type of benefit*</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="Dubai">Type of benefit</option>
                            <option value="Abu Dhabi">Supply + installation</option>

                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="city1" class="pb-2">Type of residence*</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="Dubai">Villa</option>
                            <option value="Abu Dhabi">Office</option>
                            <option value="Sharjah/Ajman">Apartment</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="city1" class="pb-2">Estimated finish date*</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="Dubai">Estimated finish date</option>
                            <option value="Abu Dhabi">Urgent</option>
                            <option value="Sharjah/Ajman">Within 3 months</option>
                            <option value="Sharjah/Ajman">Within 1 year</option>
                        </select>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>

                        <button type="submit">Confirm the visit</button>
                    </div>

                </div>
            </form>
        </div><!-- End Contact Form -->

        </div>
        </div>
        </section> --}}

        <section class="home_product">
            <div class="container">

                @foreach ($medias as $item)

                @if ($loop->index % 2 == 0)


                <div class="row home__pro">
                    <div class="col-lg-6 col-12">
                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="col-lg-6 col-12 ">
                        <div class="banner-product-content">
                            <h3 class="banner-product-title">{{ $item->title }}</h3>
                            <span class="banner-product-body">
                                <p>{{ $item->description }}</p>
                            </span>
                        </div>
                        <a href="{{ route('book') }}">
                            <button class="btn-get-started" type="button">BOOK A FREE VISIT</button>
                        </a>

                    </div>

                </div>

                @else

                <div class="row home__pro mt-5">

                    <div class="col-lg-6 col-12">
                        <div class="banner-product-content">
                            <h3 class="banner-product-title">{{ $item->title }}</h3>
                            <span class="banner-product-body">
                                <p>{{ $item->description }}</p>
                            </span>
                        </div>
                        <a href="{{ route('book') }}">
                            <button class="btn-get-started" type="button">BOOK A FREE VISIT</button>
                        </a>

                    </div>
                    <div class="col-lg-6 col-12">
                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                    </div>

                </div>
                @endif

                @endforeach


            </div>
        </section>
        <div class="pt-5 pb-5  get-estimates-home" style="border-end-start-radius: 12.5rem;">
            <div class="container">
                <div class="services-container">
                    <div class="">
                        <div class="services-header text-center">
                            <h2>Our Somfy motor for curtains</h2>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach($categories as $category)
                    @if($category->name='Curtains')
                    @foreach($category->products as $product)
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="get-estimates-home-product">
                            <div class="image_box">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}">
                            </div>
                            <div class="service-text">
                                <div class="mb-3">
                                    <a href="{{ route('product', $product->id) }}">
                                        <strong class="fs-6">{{ $product->title }}</strong>
                                    </a>
                                </div>
                                <div class="pb-3">
                                    
                                
                                     <p>
                                        {!! Str::limit($product->short_description, 20, '...') !!}
                                        @if(strlen($product->short_description) > 20)
                                            <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                                        @endif
                                    </p>
                                    <p class="full-description" style="display: none;">
                                        {!! $product->short_description !!}
                                        <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                                    </p>
                                    
                                    <a href="{{ route('product', $product->id) }}" class="btn-get-started mb-2 pb-2"
                                        style="width: 100%;border-radius: 2rem;">Find out more </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @endforeach

                </div>

            </div>
        </div>



        <section class="ctas">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="title_content mb-5">
                            <h2 class="head-title" style="color:#982f6a">{{ $page->step_six_title }}</h2>

                        </div>
                    </div>
                </div>


                <div class="row">

                    @foreach ($go_furthers as $item)
                    <div class="col-md-4 col-12">
                        <div class="cta-embed ">
                            <div class="card find_main">
                                <div class="card-body ">
                                    <h4 class="cta-embed-title" style="font-size:1.9rem">{{ $item->title }}</h4>
                                   
                                     <p class="cta-embed-text">
                                        {!! Str::limit($item->description, 120, '...') !!}
                                        @if(strlen($item->description) > 120)
                                            <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                                        @endif
                                    </p>
                                    <p class="full-description cta-embed-text" style="display: none;">
                                        {!! $item->description !!}
                                        <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                                    </p>
                                    
                                    
                                    <a href="{{ route('book') }}" class="btn-get-started mt-2"
                                        style="width: 100%;border-radius: 2rem;"><span>Find a point of
                                            sale</span></a>

                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>

            </div>

        </section>
    </main>
    @section('script')
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