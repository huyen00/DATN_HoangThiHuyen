<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <link rel="icon" href="@yield('icon')" />
    {{-- <link rel="icon" href="assets/langdingpage/images/vni/faicon.png"> --}}
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
    @if($tour->template ==null)
	<link rel="stylesheet" href="assets/css/style.css">
    @else
    <link rel="stylesheet" href="{{$tour->template->link_css}}">
    @endif


    @if($tour->template ==null)
     <link rel="stylesheet" href="assets/css/responsive.css">
    @elseif($tour->template->responsive)
        <link  rel="stylesheet" href="{{$tour->template->responsive}}">
    @else
        <link rel="stylesheet" href="assets/css/responsive.css">
    @endif

	<link rel="stylesheet" href="assets/css/jquery.pan.css" type="text/css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/map.css">

	<style>
		html { height:100%; }
		body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; background-color:#000000; }
	</style>
    <body>
        <script src="/assets/js/tour.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
        @yield('content')
        @if ($isEditor == true)
            <div id="btn_Savexml" style=" position: absolute;
            top: 300px;
            right: 20px;
            z-index: 100;
            background: black;"> Save XMl</div>
        @endif
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
        <script src="assets/js/connectxml.js"></script>


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

        <script>
            // var slideIndex = 1;
            // showDivs(slideIndex);

            // function plusDivs(n) {
            //     showDivs(slideIndex += n);
            // }

            // function showDivs(n) {
            //     var i;
            //     var x = document.getElementsByClassName("mySlides");
            //     if (n > x.length) {
            //         slideIndex = 1
            //     }
            //     if (n < 1) {
            //         slideIndex = x.length
            //     }
            //     for (i = 0; i < x.length; i++) {
            //         x[i].style.display = "none";
            //     }
            //     x[slideIndex - 1].style.display = "block";
            // }
        </script>
        <script type="text/javascript">

            $(document).ready(function() {
                $(".pan").pan();
            })
        </script>

    </body>

    <style>
        @if($tour->setting_color != null)
        {{--  Icon-color  --}}
        .title_icon_menu{
            color: {{ $tour->setting_color->icon_color ?? null }}  !important ;
        }
        .item_icon {
            background-color: {{ $tour->setting_color->bg_icon_color?? null }};
            color: {{ $tour->setting_color->icon_color?? null }};
        }
        .item_icon:hover {
            background-color: {{ $tour->setting_color->hover_bg_icon_color?? null }};
            color: {{ $tour->setting_color->hover_color_icon?? null }};
        }
        .item_icon .active {
            background-color: {{ $tour->setting_color->hover_bg_icon_color?? null }};
            color: {{ $tour->setting_color->hover_color_icon?? null }};
        }

        .item_menu_bottom  {
            background-color: {{ $tour->setting_color->bg_icon_color ?? null }};

        }
        .item_menu_bottom:hover {
            background-color: {{ $tour->setting_color->hover_bg_icon_color ?? null }};
        }
        .item_menu_bottom .active {
            background-color: {{ $tour->setting_color->active_bg_icon_color ?? null }};
        }
        .item_menu_right{
            background-color: {{ $tour->setting_color->bg_icon_color?? null }};
        }
        .item_menu_right ,i{
            color: {{ $tour->setting_color->icon_color?? null }};
        }
        .item_menu_right:hover{
            background-color: {{ $tour->setting_color->hover_bg_icon_color?? null }};
            color: {{ $tour->setting_color->hover_color_icon?? null }};
        }
        .list_setting{
            background-color: {{ $tour->setting_color->bg_icon_color ?? null }} !important;
        }
        .title_setting{
            background-color: {{$tour->setting_color->bg_icon_color ?? null}}  !important ;
            color: {{ $tour->setting_color->icon_color ?? null }}  !important ;
        }
        .item_setting:hover{
            background-color: {{$tour->setting_color->hover_bg_icon_color ?? null}}  !important ;

        }
        .item_setting.active{
            background-color: {{$tour->setting_color->active_bg_icon_color ?? null}}  !important ;

        }

        .change_sound{
            background-color: {{ $tour->setting_color->bg_icon_color?? null }};
        }
        .item_sound:hover{
            background-color: {{$tour->setting_color->hover_bg_icon_color ?? null}}  !important ;

        }
        .item_sound.active{
            background-color: {{$tour->setting_color->active_bg_icon_color ?? null}}  !important ;

        }



        {{--  End Color Icon  --}}

        {{--   Menu--}}
        .list_sub_top{
            background-color: {{$tour->setting_color->bg_menu_color??null}}
        }
        .option_menu_top{
            background-color: {{$tour->setting_color->bg_menu_color??null}}
        }

        .item_sub_top:hover{
            background-color: {{$tour->setting_color->hover_color_item ??null}}
        }
        .item_sub_top:active{
            background-color: {{$tour->setting_color->active_color_item ??null}}
        }


        {{--    --}}


        .list-thumbs{
            background-color: {{ $tour->setting_color->bg_menu_color?? null }};
        }
        .menu_sliderbar{
            background-color: {{ $tour->setting_color->bg_menu_color?? null }};
        }
        .title_menu {
            background-color: {{ $tour->setting_color->bg_color_category?? null }};
            color: {{ $tour->setting_color->color_category?? null }};
        }
        .link_menu  {

            color: {{ $tour->setting_color->color_item?? null }};
        }
        .link_menu:hover{

            color: {{ $tour->setting_color->hover_color_item?? null }};
        }
        .link_menu .active{

            color: {{ $tour->setting_color->active_color_item ?? null}};
        }

        @endif

        @if($tour->font != null)
            @font-face {
            font-family: myFirstFont;
            src: url({{ $tour->font->font }});
            }

            body, div, button, a, p {
                font-family: myFirstFont !important;
                font-size: {{ $tour->font->size }}px !important;
                font-weight: {{ $tour->font->weight }}  !important;;
            }

            iframe h1,a,p{
                font-family: myFirstFont !important;
            }
        @endif

    </style>
</head>
