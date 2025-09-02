<x-app-layout>
    @section('title') {{ $data->title ? $data->title : 'product' }} @endsection
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
                                <img src="{{ Storage::url($data->image) }}" class="display-img">
                            </div>

                        </div>
                        <div class="img-selection d-flex">
                            <div class="img-thumbnail selected">
                                <img src="{{ Storage::url($data->image) }}" width="100%">
                            </div>
                            @foreach($data->images as $image)
                                
                           
                            <div class="img-thumbnail selected">
                                <img src="{{ Storage::url($image->gallery_image) }}" width="100%">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="summary-product">
                        <h1 class="product_title entry-title">{{ $data->title }}</h1>
                        <!--@foreach($data->sizes as $size)-->
                        <!--<p class="price">-->
                        <!--    <span class="Price-amount">-->
                        <!--        <bdi>AED {{ $size->price }}</bdi>-->
                        <!--    </span>-->
                        <!--    <span class="Price-dimensions">({{ $size->width.'cm X '.$size->height.'cm' }} window)</span>-->
                        <!--</p>-->
                        <!--@endforeach-->
                        
                         @php
                            $minPrice = $data->sizes->sortBy('price')->first();
                        @endphp
                        
                        @if($data->sizes->isNotEmpty())
                           
                        
                            <p class="price">
                                <span class="Price-amount">
                                    <bdi>AED @if($data->sizes->isNotEmpty()) {{ $minPrice->price * 3 }} upfront @endif</bdi>
                                </span>
                                <span class="Price-dimensions">({{ $minPrice->width . $data->cm_length. ' X ' . $minPrice->height .$data->cm_length }}) upfront</span>
                            </p>
                        @endif
                        
                       
                        <div class="product-details__short-description">
                            <p>{!! $data->short_description !!}</p>
                        </div>
                        @if($data->sizes->isNotEmpty())
                        <div class="under-price">
                            Or <b> AED <span class="ins-price">{{ $minPrice->price }}</span>/month</b> for 3 months.
                        </div>
                        @endif
                        <div class="">
                            <!--<a href="{{ route('estimates',['product_id'=> $data->id]) }}" class="btn-get-started mt-3" style="width: 100%;">BOOK A FREE VISIT</a>-->
                            <a href="{{ route('book') }}" class="btn-get-started mt-3" style="width: 100%;">BOOK A FREE VISIT</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services Section -->
            <section id="services" class="services section mt-3">
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
                                    <span class="short-description">{{  Str::limit($service->short_description, 80, '...') }}</span>
                                    <span class="full-description" style="display: none;">{{  $service->short_description }}</span>
                                    <a href="javascript:void(0);" class="see-more text-primary">See More</a>
                                    
                                </p>
                            </div>
                          </div>
                        </div>
                        @endforeach

                    </div>

                </div>

            </section><!-- /Services Section -->



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
        </div>
        <div class="pt-3 pb-5 container  ">
            <div class="get-estimates-home p-4">

                <div class="row">
                    
                    @foreach($bestsallers as $item)
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                      <div class="get-estimates-home-product">
                        <div class="image_box">
                          <img src="{{  Storage::url($item->image) }}" alt="{{ $item->title }}">
                        </div>
                        <div class="service-text">
                          <div class="pricing-product-name ">
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

    </main>
</x-app-layout>
