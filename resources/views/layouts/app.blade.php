@php
$setting = \App\Models\Setting::first();
$social = \App\Models\SocialLink::first();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title',$setting->website_name)</title>
    <meta content="@yield('meta_description',$setting->meta_description)" name="description">
    <meta content="@yield('meta_keyword',$setting->meta_keywords)" name="keywords">
    <meta name="author" content="{{ $setting->website_name }}">
    <!-- Open Graph / Facebook / LinkedIn -->
    <meta property="og:title" content="{{ $setting->meta_title }}">
    <meta property="og:description" content="{{ $setting->meta_description }}">
    <meta property="og:image" content="@yield('meta_image', asset('storage/'.$setting->meta_image))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="{{ $setting->meta_keywords }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{ $setting->meta_keywords }}">
    <meta name="twitter:title" content="{{ $setting->meta_title }}">
    <meta name="twitter:description" content="{{ $setting->meta_description }}">
    <meta name="twitter:image" content="{{ asset('storage/'.$setting->meta_image) }}">

    <!-- Generic Image Meta -->


    <!-- Favicons -->
    <link href="{{ asset('storage/'.$setting->favicon) }}" rel="icon">
    <link href="{{ asset('storage/'.$setting->favicon) }}" rel="apple-touch-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('frontend/') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('frontend/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Main CSS File -->
    <link href="{{ asset('frontend/') }}/assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .toast-top-right{
            top: 100px !important;
        }
        .whatsapp-icon {
            position: fixed;
            bottom: 40px;
            right: 20px;
            z-index: 1000;
        }

        .whatsapp-icon a {
            text-decoration: none;
            color: #25d366;
            font-size: 60px;
        }

        .whatsapp-icon a:hover {
            color: #128c7e;
        }
    </style>
    @yield('css')
    
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '826154359592085');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=826154359592085&ev=PageView&noscript=1"
    /></noscript>
    <!-- End MetaPixel Code-->
    
     <!--Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H52877LLMH"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-H52877LLMH');
    </script>

</head>

<body class="index-page">
    
     <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2F763M3"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager(noscript) -->
    
    @include('layouts.header')
    <!-- <div id="container"> -->
    <main class="main">
        {{ $slot }}
    </main>
    @include('layouts.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    <div class="whatsapp-icon">
        <a id="whatsapp-link" href="#" target="_blank">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <!-- Preloader -->
    {{-- <div id="preloader"></div> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/') }}/assets/js/jquery.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('frontend/') }}/assets/vendor/php-email-form/validate.js"></script> --}}
    <script src="{{ asset('frontend/') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('frontend/') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('frontend/') }}/assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            // ========== Hiding Popup ============
            jQuery('span.close-popup--btn').on('click', function() {
                jQuery('.popup-section').addClass('hide-popup');
            });
            // ========== Hiding Popup ============
            jQuery('.header-column .open-popup--btn').on('click', function() {
                jQuery('.popup-section').removeClass('hide-popup');
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            const phoneNumber = "971561278800"; // Replace with your phone number
            const message = "Hello B & C,";
            const encodedMessage = encodeURIComponent(message);
            
            const whatsappLink = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodedMessage}`;
            
            $("#whatsapp-link").attr("href", whatsappLink);
        });
    </script>
    
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':
                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'warning':
                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'error':
                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
        }
        @endif
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        var thumbs = $('.img-selection').find('img');

        thumbs.click(function() {
            var src = $(this).attr('src');
            var dp = $('.display-img');
            var img = $('.zoom');
            dp.attr('src', src);
            img.attr('src', src);
        });

        $(".img-thumbnail").click(function() {
            $('.img-thumbnail').removeClass('selected');
            $(this).addClass('selected');
        });

        var zoom = $('.big-img').find('img').attr('src');
        $('.big-img').append('<img class="zoom" src="' + zoom + '">');
        $('.big-img').mouseenter(function() {
            $(this).mousemove(function(event) {
                var offset = $(this).offset();
                var left = event.pageX - offset.left;
                var top = event.pageY - offset.top;

                $(this).find('.zoom').css({
                    width: '200%',
                    opacity: 1,
                    left: -left,
                    top: -top,
                });
            });
        });

        $('.big-img').mouseleave(function() {
            $(this).find('.zoom').css({
                width: '100%',
                opacity: 0,
                left: 0,
                top: 0,
            });
        });
    </script>
    <script>
        function showHtmlDiv() {
            var htmlShow = document.getElementById("html-show");
            if (htmlShow.style.display === "block") {
                htmlShow.style.display = "none";
            } else {
                htmlShow.style.display = "block";
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.see-more').forEach(function(element) {
            element.addEventListener('click', function() {
                var shortDesc = this.previousElementSibling.previousElementSibling;
                var fullDesc = this.previousElementSibling;
    
                if (fullDesc.style.display === "none") {
                    fullDesc.style.display = "inline";
                    shortDesc.style.display = "none";
                    this.textContent = "See Less";
                } else {
                    fullDesc.style.display = "none";
                    shortDesc.style.display = "inline";
                    this.textContent = "See More";
                }
            });
        });
    });
    </script>
    

    @yield('script')
</body>

</html>