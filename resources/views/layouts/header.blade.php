<style>
    @media(max-width:576px)
    {
        /*.mobile-button{*/
        /*    display:block !important;*/
        /*}*/
        .mobile-logo{
             display:block !important;
        }
        .logo{
            display:none !important;
        }
        .mobile-nav-toggle{
            margin-right:0px !important;
        }
    }
    /*.mobile-button{*/
    /*    display:none;*/
    /*}*/
    .mobile-logo{
        display:none;
    }
</style>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="align-items-center container-fluid container-h d-flex justify-content-between position-relative">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
             @if ($setting->header_logo == null)
             <img src="{{ asset('frontend/') }}/assets/img/logo.jpg" alt="{{ $setting->website_name }}">
             @else
             <img src="{{ Storage::url($setting->header_logo) }}" alt="{{ $setting->website_name }}">
             @endif
        </a>
        
            <a href="{{ route('home') }}" class="mobile-logo" style="width:28% !important">
            <!-- Uncomment the line below if you also wish to use an image logo -->
             @if ($setting->header_logo == null)
             <img class="" src="{{ asset('frontend/') }}/assets/img/logo.jpg" alt="{{ $setting->website_name }}">
             @else
             <img class="" src="{{ Storage::url($setting->header_logo) }}" alt="{{ $setting->website_name }}">
             @endif
            </a>
        
        <a class="mobile-button btn btn-sm d-lg-none" href="{{ route('products') }}" style="font-weight:bold">Our Product</a>
       
        <a class="mobile-button btn btn-sm d-lg-none" href="{{ route('book') }}" style="font-weight:bold;padding-right:10px"></i> Book a Free Visit</a>
       
        <a class="mobile-button btn btn-sm d-none" href="{{ route('estimates') }}" style="font-weight:bold;padding-right:10px"></i> Get Estimate</a>
       
        <nav id="navmenu" class="navmenu">
            <ul>
                <!-- <li><a href="index.html#hero" class="active">Home</a></li> -->
                <li><a href="{{ route('products') }}">Our Product</a></li>
                <li><a href="{{ route('smartCurtains') }}">Smart Curtains</a></li>
                <li><a href="{{ route('team') }}">Our Team</a></li>
                <li><a href="{{ route('review') }}">Customer Feedback</a></li>
                <li><a href="{{ route('about-us') }}">About Us</a></li>
                
                <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#">Dropdown 1</a></li>
                    <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Deep Dropdown 1</a></li>
                        <li><a href="#">Deep Dropdown 2</a></li>
                        <li><a href="#">Deep Dropdown 3</a></li>
                        <li><a href="#">Deep Dropdown 4</a></li>
                        <li><a href="#">Deep Dropdown 5</a></li>
                    </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
            </ul>
        </li> -->
        <li><a href="{{ route('contact') }}">Contact Us</a></li>
        <a class="btn-getstarted header_btn bookmenu" href="{{ route('book') }}" style="margin-left: 10px;"><i
        class="bi bi-calendar2-day" style="margin-right: 5px;margin-left: 0px;font-size:23px;"></i> Book a Free Visit</a>
        <a class="btn-getstarted header_btn getestimatemenu" href="{{ route('estimates') }}" style="margin-left: 15px;"></i> Get Estimate</a>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
</div>
</header>