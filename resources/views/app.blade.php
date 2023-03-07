<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('head_title', getcong('site_name'))</title>
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('head_description', getcong('site_description'))" />

    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('head_title', getcong('site_name'))" />
    <meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
    <meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
    <meta property="og:url" content="@yield('head_url', url('/'))" />
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ URL::asset('upload/' . getcong('site_favicon')) }}" type="image/x-icon">
    <!--MAIN STYLE-->
    <link href="{{ URL::asset('site_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {!! getcong('site_header_code') !!}
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />

</head>

<body>
    <div id="wrap" class="home-1">
        @include('_particles.header')

        @yield('content')

        @include('_particles.footer')

        <div class="rights">
            <div class="container">
                <p class="font-montserrat">
                    @if (getcong('site_copyright'))
                        {{ getcong('site_copyright') }}
                    @else
                        Copyright © {{ date('Y') }} {{ getcong('site_name') }}. All rights reserved.
                    @endif
                </p>
            </div>
        </div>

        <script src="{{ URL::asset('site_assets/js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/jquery.flexslider-min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/jquery.nouislider.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/jquery.sticky.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/jquery.stellar.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/wow.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/own-menu.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/main.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('site_assets/js/jquery.flexslider-min.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		@yield('script')
		<script>
			<script>
				@if(Session::has('message'))
			  toastr.options =
			  {
			  	"closeButton" : true,
			  	"progressBar" : true
			  }
			  		toastr.success("{{ session('message') }}");
			  @endif
			
			  @if(Session::has('error'))
			  toastr.options =
			  {
			  	"closeButton" : true,
			  	"progressBar" : true
			  }
			  		toastr.error("{{ session('error') }}");
			  @endif
			
			  @if(Session::has('info'))
			  toastr.options =
			  {
			  	"closeButton" : true,
			  	"progressBar" : true
			  }
			  		toastr.info("{{ session('info') }}");
			  @endif
			
			  @if(Session::has('warning'))
			  toastr.options =
			  {
			  	"closeButton" : true,
			  	"progressBar" : true
			  }
			  		toastr.warning("{{ session('warning') }}");
			  @endif
			</script>
		</script>
</body>

</html>

</div>
</body>

</html>
