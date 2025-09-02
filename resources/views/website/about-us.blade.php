<x-app-layout>
    @section('title') {{ $pageTitle }} | {{ $page->title ?? 'About Us' }} @endsection


    @section('meta_title') {{ $page->title ?? 'About Us' }} @endsection
    @section('meta_description') {{ $page->meta_description ?? '' }} @endsection
    @section('meta_keyword') {{ $page->meta_keywords ?? '' }} @endsection

    @section('meta_image')
    @if($page)
    {{ asset('storage/'.$page->meta_image) }}
    @else
    ''
    @endif
    @endsection

    @php
    $title = \App\Models\SectionTitle::first();
    @endphp

    <style>
        @media(max-width:576px)
        {
            .founder{
                text-align:center;
            }
        }
    </style>

    <main class="main">
        <div class="about__banner">
            <img src="{{ Storage::url($aboutus->bgimage) }}" alt="">
            <div class="about-us-image-text">
                <h2 style="text-align: center;">{{ $title->about_us_section_title }}</h2>
                <p style="text-align: center;">{{ $title->about_us_section_description }}</p>
            </div>
        </div>


        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h2>{{ $page?->title }}</h2>
                {!! $page?->content !!}
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row mb-3">
                    <div class="col-lg-6 mb-2">
                        <div class="row">
                            <!--<div class="col-lg-2 col-12 text-center text-lg-left">-->
                            <!--    <img style="width:100px;height:100px" src="{{ Storage::url($aboutus->founder_image) }}" alt="{{ $aboutus->founder_title }}" class="img-fluid">-->
                            <!--</div>-->
                            <div class="col-lg-12 founder">
                                <img style="width:120px;height:120px;border-radius:50%;" src="{{ Storage::url($aboutus->founder_image) }}" alt="{{ $aboutus->founder_title }}" class="img-fluid">
                                <h4 class="mb-0">{{ $aboutus->founder_title }}</h4>
                                <p class="mb-0">{{ $aboutus->founder_designation }}</p>
                                <p class="mb-0" style="text-align:justify">{{ $aboutus->founder_description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <div class="row">
                            <!--<div class="col-lg-2 col-12 text-center text-lg-left">-->
                            <!--     <img style="width:120px;height:120px;border-radius:50%;" src="{{ Storage::url($aboutus->cofounder_image) }}" alt="{{ $aboutus->cofounder_title }}" class="img-fluid">-->
                            <!--</div>-->
                            <div class="col-lg-10 founder">
                                <img style="width:120px;height:120px;border-radius:50%;" src="{{ Storage::url($aboutus->cofounder_image) }}" alt="{{ $aboutus->cofounder_title }}" class="img-fluid">
                                <h4 class="mb-0">{{ $aboutus->cofounder_title }}</h4>
                                <p class="mb-0">{{ $aboutus->cofounder_designation }}</p>
                                <p class="mb-0" style="text-align:justify">{{ $aboutus->cofounder_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 pt-4">
                    <div class="col-lg-6">
                         <h1>{{ $aboutus->vision_title }}</h1>
                         
                         <div>
                            {!! Str::limit($aboutus->vision_description, 500, '...') !!}
                            @if(strlen($aboutus->vision_description) > 500)
                                <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                            @endif
                        </div>
                        <div class="full-description" style="display: none;">
                            {!! $aboutus->vision_description !!}
                            <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div>
                            <img src="{{ Storage::url($aboutus->vision_image) }}" alt="{{ $aboutus->vision_title }}" class="img-fluid" style="height:350px;">
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div>
                            <img src="{{ Storage::url($aboutus->mission_image) }}" alt="{{ $aboutus->mission_title }}" class="img-fluid" style="height:350px;">
                        </div>

                    </div>
                    <div class="col-lg-6">
                         <h1>{{ $aboutus->mission_title }}</h1>
                         <div>
                            {!! Str::limit($aboutus->mission_description, 500, '...') !!}
                            @if(strlen($aboutus->mission_description) > 500)
                                <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                            @endif
                        </div>
                        <div class="full-description" style="display: none;">
                            {!! $aboutus->mission_description !!}
                            <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                        </div>
                        
       
                    </div>
                </div>
                
                <div class="row mt-5">
                    
                    <div class="col-lg-6">
                         <h1>{{ $aboutus->partnership_title }}</h1>
                         <div>
                            {!! Str::limit($aboutus->partnership_description, 500, '...') !!}
                            @if(strlen($aboutus->partnership_description) > 500)
                                <a href="javascript:void(0);" class="see-more text-danger">See More</a>
                            @endif
                        </div>
                        <div class="full-description" style="display: none;">
                            {!! $aboutus->partnership_description !!}
                            <a href="javascript:void(0);" class="see-less text-danger">See Less</a>
                        </div>
       
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <img src="{{ Storage::url($aboutus->partnership_image) }}" alt="{{ $aboutus->partnership_title }}" class="img-fluid" style="height:350px;">
                        </div>

                    </div>
                </div>
                
              

            </div>



            <div class="container pt-5 mt-4">
                <div class="text-center">
                    <h2>{{ $title->service_section_title }}</h2>
                    <p>{{ $title->service_section_description }}</p>
                </div>
                <div class="row gy-4 mt-3">
                    @foreach ($services as $service)
                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative p-0">
                            <div class="icon">
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}">
                                <!-- <i class="bi bi-activity icon"></i> -->
                            </div>
                            <h4 class="p-3"><a href="{{ route('service',$service->id) }}" class="stretched-link">{{ $service->title }}</a></h4>
                        </div>
                    </div>
                    @endforeach


                </div>

            </div>


        </section>





        <!-- ======= Team Section ======= -->
        <section id="team" class="team ">
            <div class="container">
                <div class="text-center">
                    <p class="m-0">{{ $title->team_section_title }}</p>
                    <h2 class="team_section">{{ $title->team_section_description }}</h2>
                </div>
                <div class="row">

                    @foreach ($teams as $team)

                    <div class="col-lg-6 mb-2">
                        <div class="member align-items-start">
                            <div class="text-center mb-3"><img src="{{ Storage::url($team->image) }}"
                                    class="img-fluid" alt="{{ $team->name }}" style="width: 250px;height: 250px;"></div>
                            <div class="member-info">
                                <h4 class="text-center">{{ $team->name }}</h4>
                                <span class="text-center">{{ $team->designation }}</span>
                                <p>{{ $team->description }}</p>
                                <div class="social">
                                    @if($team->facebook)
                                    <a href="{{ $team->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                    @endif
                                    @if($team->twitter)
                                    <a href="{{ $team->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a>
                                    @endif
                                    @if($team->instagram)
                                    <a href="{{ $team->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                    @endif
                                    @if($team->linkdedin)
                                    <a href="{{ $team->linkdedin }}" target="_blank"> <i class="bi bi-linkedin"></i> </a>
                                    @endif
                                    @if($team->pinterest)
                                    <a href="{{ $team->pinterest }}" target="_blank"> <i class="bi bi-pinterest"></i> </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </section><!-- End Team Section -->

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