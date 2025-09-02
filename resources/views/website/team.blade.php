<x-app-layout>
    @section('title')
    {{ $pageTitle }} | Team
    @endsection
    
@php
$title = \App\Models\SectionTitle::first();
@endphp
    <main class="main">

        <!-- ======= Breadcrumbs ======= -->
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Team</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Team</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <!-- End Breadcrumbs -->

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
                                    class="img-fluid" alt="{{ $team->name }}" style="width: 175px;height: 175px;border-radius:50%;"></div>
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
</x-app-layout>