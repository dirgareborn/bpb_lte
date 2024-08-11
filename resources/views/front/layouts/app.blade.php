<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>BPB - Universitas Negeri Makassar</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
	<meta property="og:locale" content="id_ID">
	<meta property="og:type" content="article">
	<meta property="og:url" content="{{ Request::url() }}">
	<meta property="og:site_name" content="{{ \URL::to('') }}">
	<meta property="og:title" content="{{ $page_title ?? '' }}">
	<meta property="og:description" content="{{ $page_description ?? 'Website Resmi BPB UNM' }}. ">
	<meta property="og:image" content="{{ is_logo($page_image ?? '') }}?auto=format&amp;fit=max&amp;w=1200">
	<meta property="og:image:alt" content="{{ is_logo($page_image ?? '') }}">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $page_title ?? '' }}">
	<meta name="twitter:description" content="{{ $page_description ?? 'Website Resmi BPB UNM' }}. ">
	<meta name="twitter:image" content="{{ is_logo($page_image ?? '') }}?auto=format&amp;fit=max&amp;w=1200">
	<link rel="alternate" href="/feed.xml" type="application/atom+xml" data-title="{{ Request::url() }}">
	<meta name="facebook-domain-verification" content="w5e39xmuhdt35pjpezg5pkif7f501x" />
    <!-- Favicon -->
	<link rel="icon" type="image/png" href="{{url('favicon.ico') }}"/>
	<link rel="mask-icon" href="{{url('favicon.ico') }}" color="#5bbad5">
   
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{url('front/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{url('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{url('front/css/custom_style.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />
    <!-- Scripts -->
     @stack('style')
	  @laravelPWA
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        @include('front.partials.navbar')
        @if(Route::is('beranda'))
        @include('front.partials.slider') 
        @include('front.partials.search')
        @endif  
        @yield('content')
        @if(Route::is('beranda'))
        @include('front.partials.testimonial')
        @endif
        @include('front.partials.footer')
		@include('front.layouts.menu-bottom')
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ url('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
     <script src="{{ url('front/js/main.js') }}"></script>
     <script src="{{ url('front/js/custom.js') }}"></script>
     <script src="https://unpkg.com/feather-icons@4.29.2/dist/feather.min.js"></script>

    @stack('scripts')
	
	<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbarBottom").style.bottom = "0";
      } else {
        document.getElementById("navbarBottom").style.bottom = "-70px";
      }
      prevScrollpos = currentScrollPos;
    }
    </script>
</body>

</html>