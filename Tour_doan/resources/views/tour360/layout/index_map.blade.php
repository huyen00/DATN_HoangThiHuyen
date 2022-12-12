<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    {{-- <link rel="icon" href="@yield('icon')" /> --}}
    <link rel="icon" href="assets/langdingpage/images/vni/faicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta property="og:image" content="@yield('image')" />
    <meta name="copyright" content="Holomia">
    <meta name="generator" content="holomia.com">
    <meta name="author" content="holomia.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">
	<link rel="stylesheet" href="assets/css/jquery.pan.css" type="text/css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/map.css">

    <body>
        <script src="/assets/js/tour.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
        @yield('content')

        <div class="panWrapper" id="minimap" style="display: none;">
			<a class="controls in"></a>
			<a class="controls out"></a>
			<img class="i image_pan mx-auto d-block center-block"
				style="position: absolute; width: auto; left: -13px; top: 114.5px;"
				src="assets/img/Map_DinhVi.jpg">
		</div>

        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.js "
        integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin=" anonymous "></script> --}}
        <script src="assets/js/jquery.pan.js"></script>
        {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        {{-- <script src="assets/js/responsive.js"></script> --}}


        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        {{--  @if($tour->template ==null)  --}}
        <script src="assets/js/main.js"></script>
        {{--  @else
        <script href="{{$tour->template->link_js}}"></script>
        @endif  --}}

        @if($tour->template ==null)

        @elseif($tour->template->link_js)

            <script src="{{$tour->template->link_js}}"></script>
        @else

        @endif

        <script type="text/javascript">

            $(document).ready(function() {
                $(".pan").pan();
            })
        </script>

    </body>
</head>
