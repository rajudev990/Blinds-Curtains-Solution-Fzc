<x-app-layout>
@section('title') {{ $page->website_name }} | Contact Us @endsection

@php
$title = \App\Models\SectionTitle::first();
@endphp
    <main class="main">

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $title->contact_section_title }}</h2>
                <p>{{ $title->contact_section_description }}</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">

                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Address</h3>
                                    <p>{{ $page->address }}</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>{{ $page->phone }}</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>{{ $page->email }}</p>
                                </div>
                            </div><!-- End Info Item -->
                            
                            {!! $page->google_map !!}
                            
                            

                        </div>
                    </div>

                    <div class="col-lg-7">
                        <form action="{{ route('contact-send') }}" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            @csrf
                            @method('post')
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <label for="name-field" class="pb-2">Your Name</label>
                                    <input type="text" name="name" id="name-field" class="form-control @error('name') is-invalid @enderror"
                                        required="">
                                        @error('name')
                                        <div role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror 
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Your Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email-field"
                                        required="">
                                        @error('email')
                                        <div role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror 
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject-field"
                                        required="">
                                        @error('subject')
                                        <div role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror 
                                </div>

                                <div class="col-md-12">
                                    <label for="message-field" class="pb-2">Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10" id="message-field" required=""></textarea>
                                    @error('message')
                                        <div role="alert" class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror 
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit" style="background-color:#982f6a">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
</x-app-layout>
