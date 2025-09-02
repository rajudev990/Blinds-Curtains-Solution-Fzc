<x-app-layout>

    @section('title') {{ $service->title ? $service->title : '' }} @endsection
    @section('meta_title') {{ $service->title ? $service->title : '' }} @endsection
    @section('meta_description') {{ $service->short_description ? $service->short_description : '' }} @endsection
    @section('meta_keyword') {{ $service->short_description ? $service->short_description : '' }} @endsection

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ $service->title }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">{{ $service->title }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Service Details Section -->
        <section id="service-details" class="service-details section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="services-list">
                            @foreach ($services as $item)
                                <a href="{{ route('service',$item->id)  }}" class="{{ $service->id == $item->id ? 'active' : '' }}">{{ $item->title }}</a>
                            @endforeach
                        </div>

                        <h4>{{ $service->title }}</h4>
                        <p>{{ $service->short_description }}</p>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="img-fluid services-img">
                        <h3>{{ $service->title }}</h3>
                        {!! $service->description !!}
                    </div>

                </div>

            </div>

        </section><!-- /Service Details Section -->

    </main>
</x-app-layout>