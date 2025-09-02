<x-app-layout>
    @section('title')
    {{ $pageTitle }} | Offer Page For 10% Discount
    @endsection

    @php
    $title = \App\Models\SectionTitle::first();
    @endphp

<style>
    @media (max-width: 576px) {
    .mobile-button {
        font-size: 13px;
    }
}
</style>
    <section class="banner_title__main p-0">
        <div class="container-xxl container-xl container-lg-fluid p-0">
            <div class="row">
                <div class="col-lg-12 m-auto text-center">
                    <!--<div class="" data-aos="fade-up" data-aos-delay="100">-->
                    <div class="">

                        <div class="swiper init-swiper">
                            <script type="application/json" class="swiper-config">
                                {
                                    "loop": true,
                                    "speed": 900,
                                    "autoplay": {
                                        "delay": 5000
                                    },
                                    "slidesPerView": "auto",
                                    "pagination": {
                                        "el": ".swiper-pagination",
                                        "type": "bullets",
                                        "clickable": true
                                    },
                                    "breakpoints": {
                                        "320": {
                                            "slidesPerView": 1,
                                            "spaceBetween": 40
                                        },
                                        "480": {
                                            "slidesPerView": 1,
                                            "spaceBetween": 60
                                        },
                                        "640": {
                                            "slidesPerView": 1,
                                            "spaceBetween": 80
                                        },
                                        "992": {
                                            "slidesPerView": 1,
                                            "spaceBetween": 120
                                        }
                                    }
                                }
                            </script>
                            <div class="swiper-wrapper align-items-center">
                                @foreach ($banners as $baner)

                                <div class="swiper-slide banner__img"><a href="{{ $baner->banner_link }}" target="_blank">
                                        <img src="{{ Storage::url($baner->image) }}" class="img-fluid" alt="">
                                    </a>
                                </div>

                                @endforeach

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>






    @if($heros->status==1)
    <section class="banner_title__main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 m-auto text-center">
                    <div class="pr-0 ">
                        <div class="">
                            <div class="">
                                <h1>{{ $heros->title }}</h1>
                                <h1><span class="without-hassle" style="color:#053669">{{ $heros->tag_line }}</span></h1>
                            </div>
                            <div class="overlay-header-text-subtitle mt-3">
                                <p class="mb-0">{{ $heros->description }}</p>
                            </div>
                            <div class="text-center">
                                <p> {{ $heros->address }}</p>
                            </div>
                        </div>
                        <div class="banner_btn d-block mt-4">
                            <a href="{{ route('book') }}" class="btn-get-started">Book a Free Visit</a>
                            <!--<a href="{{ route('book') }}" class="btn-get-started" style="margin-right: 10px;">Book a Free Visit</a>-->
                            <!--<a href="{{ route('estimates') }}" class="btn-get-started">Get an Estimate</a>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    
    <style>
        @media (min-width:992px)
        {
            .banner{
                height:75%;
            }   
        }
        @media(max-width:575px)
        {
            .offer{
                padding-top:0px !important;
            }
        }
        
    </style>
    
     <section class="banner_title__main offer">
        <div class="container">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <img src="{{ asset('frontend/offer.JPG') }}" alt="" class="img-fluid banner">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <h3 class="pt-lg-5">Enjoy an exclusive 10% off your first purchase!</h3>

                        <p>
                            Join the Blinds & Curtains Solutions family by signing up today, and receive an additional 10% discount on your first custom-made order. Experience the finest in tailored elegance with us.
                        </p>
                        <form action="{{ route('offer-store') }}" method="post" class="php-email-form">
                            @csrf
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group mb-2">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="phone" placeholder="Your Phone" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" style="background-color: #982f6a;color:white;" class="btn btn-sm text-center w-100">GET YOUR DISCOUNT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="home_product">
        <div class="container">

            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-success" style="font-weight: bold;">{{ $title->home_section_title }}</h1>
                </div>
            </div>

            @foreach ($estimate_lists as $item)

            @if ($loop->index % 2 == 0)

            <div class="row home__pro mt-5">
                <div class="col-lg-6 col-12">
                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                </div>
                <div class="col-lg-6 col-12 ">
                    <div class="banner-product-content mb-4">
                        <h3 class="banner-product-title">{{ $item->title }}</h3>
                        <span class="banner-product-body">
                            {{ $item->description }}
                        </span>
                    </div>
                    <div class="banner-product-link">
                        <a href="{{ route('book') }}">
                            <button class="btn-get-started" type="button">Book a Free Visit</button>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="row home__pro mt-5">
                <div class="col-lg-6 col-12">
                    <div class="banner-product-content mb-4">
                        <h3 class="banner-product-title">{{ $item->title }}</h3>
                        <span class="banner-product-body">
                            {{ $item->description }}
                        </span>
                    </div>
                    <div class="banner-product-link">
                        <a href="{{ route('book') }}">
                            <button class="btn-get-started" type="button">Book a Free Visit</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                </div>
            </div>

            @endif

            @endforeach


        </div>
    </section>


    @php
    $project_highligts = \App\Models\ProjectHighlight::where('status',1)->get();
    @endphp

    <!-- Services Section -->
    <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Latest Projects Highlights</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">

                @foreach ($project_highligts as $video)
                <div class="col-xl-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative p-0">
                        <div class="icon">
                            <iframe width="100%" height="400" src="{{ $video->video }}" title="{{ $video->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>

                        <div class="p-2">
                            <h4>{{ $video->title }}</h4>
                            <p>{{ Str::words($video->description, 30, '...') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>

        </div>

    </section><!-- /Services Section -->


    <!-- Services Section -->
    <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $title->service_section_title }}</h2>
            <p>{{ $title->service_section_description }}</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                @foreach ($services as $service)
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative p-0">
                        <div class="icon">
                            <a href="{{ route('service',$service->id) }}">
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}">
                            </a>
                            <!-- <i class="bi bi-activity icon"></i> -->
                        </div>
                        <div class="p-2">
                            <h4><a href="{{ route('service',$service->id) }}">{{ $service->title }}</a></h4>
                            <p class="text-justify">
                                <span class="short-description">{{ Str::limit($service->short_description, 80, '...') }}</span>
                                <span class="full-description" style="display: none;">{{ $service->short_description }}</span>
                                <a href="javascript:void(0);" class="see-more text-primary">See More</a>

                            </p>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>

        </div>

    </section><!-- /Services Section -->







    <div class="pt-5 pb-5  get-estimates-home">
        <div class="container">
            <div class="services-container">
                <div class="">
                    <div class="services-header text-center">
                        <h2>{{ $title->best_seller_section_title }}</h2>
                    </div>
                    <div class="services-subtitle text-center mt-3">
                        <p>{{ $title->best_seller_section_description }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                @foreach($bestsallers as $item)
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="get-estimates-home-product">
                        <div class="image_box">
                            <img src="{{  Storage::url($item->image) }}" alt="{{ $item->title }}">
                        </div>
                        <div class="service-text">
                            <div class="pricing-product-name ">
                                <!--<a href="{{ route('estimates', ['product_id' => $item->id]) }}">-->
                                <a href="{{ route('estimates') }}">
                                    <h3>{{ $item->title }}</h3>
                                </a>
                            </div>

                            <div class="pricing-product-price mt-3">

                                @if($item->sizes->isNotEmpty())
                                @php
                                $minPrice = $item->sizes->min('price');
                                @endphp
                                <p>~ AED @if($item->sizes->isNotEmpty()) {{ $minPrice * 3 }} upfront @endif</p>
                                @endif
                            </div>
                            <div class="pricing-product-description">
                                <p class="product-price">{{ Str::limit($item->short_description,40,'...') }}</p>
                                <p class="product-price">Or AED
                                    <b>{{ $minPrice }} /mo </b>
                                </p>
                                <!-- @if($item->sizes->isNotEmpty())
                {{ $item->sizes->first()->price * 3  }}
                @endif -->
                                <div class="text-center mt-2">
                                    <a class="btn-get-started"
                                        href="{{ route('book') }}">Book a Free Visit</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                @endforeach



            </div>

        </div>
    </div>




    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $title->portfolio_section_title }}</h2>
            <p>{{ $title->portfolio_section_description }}</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach($categories as $category)
                    <li data-filter=".filter-{{ $category->id }}">{{ $category->name }}</li>
                    @endforeach
                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach($categories as $category)
                    @foreach($category->products as $product)
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $category->id }}">
                        <div class="portfolio-content h-100">
                            <img src="{{ Storage::url($product->image) }}" class="img-fluid" alt="{{ $product->title }}">
                            <div class="portfolio-info">
                                <h4>{{ $category->name }}</h4>
                                <p>{{ $product->title }}</p>
                                <a href="{{ Storage::url($product->image) }}" title="{{ $product->title }}" data-gallery="portfolio-gallery-{{ $category->id }}" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="{{ route('estimates', ['product_id' => $product->id]) }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->
                    @endforeach
                    @endforeach
                </div><!-- End Portfolio Container -->


            </div>

        </div>

    </section><!-- /Portfolio Section -->



    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $title->client_section_title }}</h2>
            <p>{{ $title->client_section_description }}</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    @foreach ($clients as $item)
                    <div class="swiper-slide"><img src="{{ Storage::url($item->image) }}" class="img-fluid" alt=""></div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Clients Section -->


    <!-- Offer Modal -->
    <div style="z-index: 99999999;background-color: rgba(0, 0, 0, 0.5) !important;" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body position-relative p-sm-3">
                    <button style="position: absolute;right:7px;top:5px;font-size: 13px;font-weight: 900;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <img src="{{ asset('frontend/offer.JPG') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-6 mb-2">
                            <h3>Enjoy an exclusive 10% off your first purchase!</h3>

                            <p>
                                Join the Blinds & Curtains Solutions family by signing up today, and receive an additional 10% discount on your first custom-made order. Experience the finest in tailored elegance with us.
                            </p>
                            <form action="{{ route('offer-store') }}" method="post" class="php-email-form">
                                @csrf
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="name1" name="name" placeholder="Your Name" required>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="email" class="form-control" id="email1" name="email" placeholder="Your Email" required>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="phone1" name="phone" placeholder="Your Phone" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" style="background-color: #982f6a;color:white;" class="btn btn-sm text-center w-100">GET YOUR DISCOUNT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    


    @section('script')


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.php-email-form');

    if (form) {
        form.addEventListener('submit', function (e) {
            // Prevent default form submission temporarily for testing
            // e.preventDefault();

            const name = document.querySelector('[name="name"]').value;
            const phone = document.querySelector('[name="phone"]').value;
            const email = document.querySelector('[name="email"]').value;

            // Push the data to the dataLayer
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({ book: null });
            window.dataLayer.push({
                event: "offer",
                offerstore: {
                    customerFullName: name,
                    customerEmail: email,
                    customerPhoneNumber: phone,
                },
            });

            console.log('DataLayer Push Successful:', {
                event: "offer",
                offerstore: {
                    customerFullName: name,
                    customerEmail: email,
                    customerPhoneNumber: phone,
                },
            });

            // Submit the form after pushing data
            setTimeout(() => form.submit(), 500);
        });
    } else {
        console.error('Form not found. Check the selector.');
    }
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let lastScrollPosition = window.scrollY;

        window.addEventListener('scroll', function () {
            const currentScrollPosition = window.scrollY;

            // Check if the user is scrolling up
            if (currentScrollPosition < lastScrollPosition) {
                // Push the data to the dataLayer
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: "scrollUp",
                    interaction: {
                        action: "User scrolled up",
                        scrollPosition: currentScrollPosition,
                    },
                });

                console.log('ScrollUp event pushed to dataLayer:', currentScrollPosition);
            }

            // Update lastScrollPosition to current position
            lastScrollPosition = currentScrollPosition;
        });
    });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                myModal.show();
            }, 4000); // 4000ms = 4 seconds
        });
    </script>
    
   
   

    @endsection

</x-app-layout>