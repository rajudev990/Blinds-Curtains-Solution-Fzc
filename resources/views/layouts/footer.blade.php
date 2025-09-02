<footer id="footer" class="footer position-relative">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    @if ($setting->footer_logo == null)
                    <img src="{{ asset('frontend/') }}/assets/img/logo.jpg" alt="{{ $setting->website_name }}" style="width: 120px;">
                    @else
                    <img src="{{ Storage::url($setting->footer_logo) }}" alt="{{ $setting->website_name }}" style="width: 120px;">
                    @endif
                    <!-- <h1 class="sitename">Ninestars</h1> -->
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ $setting->footer_text }}</p>
                    <p>{{ $setting->address }}</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>{{ $setting->phone }}</span></p>
                    <p><strong>Email:</strong> <span>{{ $setting->email }}</span></p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('/') }}">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('about-us') }}">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('terms') }}">Terms of service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('estimates') }}">Get estimate</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('book') }}">
                            Book a Free Visit</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('help') }}">Frequently Asked Questions</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h4>Follow Us</h4>
                <p>{{ $setting->follow_us }}</p>
                @if ($social->status==1)
                <div class="social-links d-flex">
                    @if($social->facebook)
                    <a href="{{ $social->facebook ? $social->facebook : '' }}" target="_blank"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($social->twitter)
                    <a href="{{ $social->twitter ? $social->twitter : '' }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if($social->linkedin)
                    <a href="{{ $social->linkedin ? $social->linkedin : '' }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if($social->instagram)
                    <a href="{{ $social->instagram ? $social->instagram : '' }}" target="_blank"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if($social->pinterest)
                    <a href="{{ $social->pinterest ? $social->pinterest : '' }}" target="_blank"><i class="bi bi-pinterest"></i></a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container copyright text-center mt-4">
        <p>© <strong class="px-1 sitename">{{ $setting->copy_wright }}</strong> <span>All Rights Reserved</span>
        </p>
    </div>
</footer>