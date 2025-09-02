<x-app-layout>
    @section('title') Our-Products @endsection
    
@php
$title = \App\Models\SectionTitle::first();
@endphp
    <main class="main">

        <!-- ======= Breadcrumbs ======= -->
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Our Products</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Our Products</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <!-- End Breadcrumbs -->

        <div id="product" class="our-product-area area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline">
                            <h2 class="mb-5">{{ $title->product_section_title }}</h2>
                        </div>
                        <nav class="our_tabs">
                            <div class="nav nav-tabs m-0" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">All</button>
                                @foreach ($category as $item)
                                @if($item->id==4)
                                @else
                                <button class="nav-link" id="nav-{{ $item->id }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-{{ $item->id }}" type="button" role="tab"
                                    aria-controls="nav-{{ $item->id }}"
                                    aria-selected="false">{{ $item->name }}</button>
                                    @endif
                                @endforeach

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">

                                <div class="row">
                                    @foreach ($data as $item)
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('product', $item->id) }}">
                                                    <img src="{{ Storage::url($item->image) }}" alt="">
                                                </a>

                                            </div>
                                            <div class="product-content text-center">
                                                <div class="category-products">
                                                    <h2>{{ $item->title }}</h2>
                                                </div>
                                                <div class="category-page">
                                                    <p>{{ Str::limit($item->short_description,90,'...') }}</p>
                                                </div>
                                                <!-- @foreach ($item->sizes as $size)
                                                        <div class="our_product_price d-flex">
                                                            <p class="Price-amount" style="margin-right: 5px;">
                                                                AED {{ $size->price }}
                                                            </p>
                                                            <p class="dimensions">
                                                                ({{ $size->width . 'cm X ' . $size->height . 'cm' }}
                                                                window) </p>

                                                        </div>
                                                    @endforeach -->
                                                    
                                               
                                                @if($item->sizes->isNotEmpty())
                                                @php
                                                    $minPriceSize = $item->sizes->sortBy('price')->first();
                                                @endphp

                                                <div class="our_product_price d-flex">
                                                    
                                                    <p class="Price-amount" style="margin-right: 5px;"> AED {{ $minPriceSize->price * 3 }}</p>
                                                    <p class="dimensions">({{ $minPriceSize->width . $item->cm_length. ' X ' . $minPriceSize->height .$item->cm_length }}) upfront</p>

                                                </div>
                                               

                                                <div class="sub-price text-start">
                                                    or <b>AED {{ $minPriceSize->price }}/month</b> for 3 months
                                                </div>
                                                @else
                                                <div class="our_product_price d-flex">
                                                    
                                                    <p class="Price-amount" style="margin-right: 5px;">......</p>
                                                    <p class="dimensions">.......</p>

                                                </div>
                                               

                                                <div class="sub-price text-start">
                                                    <b>........</b>
                                                </div>
                                                 @endif
                                                <div class="mt-3 d-flex">
                                                    <a class="btn-get-started"
                                                        href="{{ route('book') }}">Book a Free Visit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End column -->
                                    @endforeach


                                </div>
                            </div>
                            @foreach ($category as $item)
                            <div class="tab-pane fade" id="nav-{{ $item->id }}" role="tabpanel"
                                aria-labelledby="nav-{{ $item->id }}-tab">
                                <div class="row">
                                    @foreach ($data->where('category_id',$item->id) as $item)
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('product', $item->id) }}">
                                                    <img src="{{ Storage::url($item->image) }}" alt="">
                                                </a>

                                            </div>
                                            <div class="product-content text-center">
                                                <div class="category-products">
                                                    <h2>{{ $item->title }}</h2>
                                                </div>
                                                <div class="category-page">
                                                    <p>{{ Str::limit($item->short_description,90,'...') }}</p>
                                                </div>
                                                
                                                @if($item->sizes->isNotEmpty())
                                                <div class="our_product_price d-flex">
                                                    @php
                                                    $minPriceSize = $item->sizes->sortBy('price')->first();
                                                    @endphp
                                                    <p class="Price-amount" style="margin-right: 5px;"> AED {{ $minPriceSize->price * 3 }}</p>
                                                    <p class="dimensions">({{ $minPriceSize->width . $item->cm_length. ' X ' . $minPriceSize->height .$item->cm_length }}) upfront</p>

                                                </div>
                                                @endif

                                                <div class="sub-price text-start">
                                                    or <b>AED {{ $minPriceSize->price }}/month</b> for 3 months
                                                </div>
                                                
                                                <!--@foreach ($item->sizes as $size)-->
                                                <!--<div class="our_product_price d-flex">-->
                                                <!--    <p class="Price-amount" style="margin-right: 5px;">-->
                                                <!--        AED {{ $size->price }}-->
                                                <!--    </p>-->
                                                <!--    <p class="dimensions">-->
                                                <!--        ({{ $size->width . 'cm X ' . $size->height . 'cm' }}-->
                                                <!--        window) </p>-->

                                                <!--</div>-->
                                                <!--@endforeach-->
                                                <!--<div class="sub-price text-start">-->
                                                <!--    or <b>AED {{ $item->price }}/month</b> for 3 months-->
                                                <!--</div>-->
                                                <div class="mt-3 d-flex">
                                                    <!--<a class="btn-get-started" href="{{ route('estimates', ['product_id' => $item->id]) }}">Book a Free Visit</a>-->
                                                    <a class="btn-get-started" href="{{ route('book') }}">Book a Free Visit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End column -->
                                    @endforeach


                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>
</x-app-layout>