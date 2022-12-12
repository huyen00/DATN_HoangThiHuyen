@extends('tour360.layout.index')
@section('title', $tour->name)
@section('image',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->thumb : null))

@section('content')
<div id="pano" style="width:100%;height:100%;">
    <noscript>
        <table style="width:100%;height:100%;">
            <tr style="vertical-align:middle;">
                <td>
                    <div style="text-align:center;">ERROR:<br /><br />Javascript not activated<br /><br />
                    </div>
                </td>
            </tr>
        </table>
    </noscript>
    <div id="btn_Savexml" style="    position: absolute;
    top: 10px;
    right: 20px;
    z-index: 100;
    background: black;"> Save XMl</div>
    {{-- sidebar --}}
    <div class="logo_tour ">
        <img src="{{ ($tour->setting_tour != null ) ? $tour->setting_tour->logo : null }}" class="img-fluid " alt="">
        <li class="logo_ocop">
            Doanh nghiệp OCOP 4 *
        </li>
    </div>
    <div class="thumblist">
        <div class="owl-carousel owl-theme" id=" thumbs">
            @foreach ($tour->panos as $key=>$pano)
            <div class="item  @if($key == 0) active @endif {{ $pano->id_thumb }}" id="{{ $pano->id_thumb }}">
                <img src="{{ $pano->thumb_img }}" class="img-thumb" alt="">
                <div class="content-thumb ">
                    <span class="title-thumb">{{ $pano->name }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="show_menu">
        <li class="item_icon icon_show_menu arrow-right ">
            <i class="fas fa-caret-right "></i>
        </li>
        <li class="item_icon icon_show_menu arrow-left">
            <i class="fas fa-caret-left"></i>
        </li>
    </div>
    <div class="menu_sliderbar">
        <div class="list_sliderbar">
            <div class="slider_logo">
                <img src="{{ ($tour->setting_tour != null ) ? $tour->setting_tour->logo : null }}" class="img-fluid"
                    alt="">
                <li class="slider_logo_ocop">
                    Doanh nghiep OCOP 4*
                </li>
            </div>
            <div class="menu_sub_slider">
                <ul class="sub_slider">
                    @foreach ($tour_group as $group_title => $group)
                    <li class="item_menu">
                        <h2 class=" title_menu">{{ $group_title }} </h2>
                        <ul>
                            @foreach ($group as $item)
                            <li class="item_sub  {{ $item->id_thumb }}" id="{{ $item->id_thumb }}">
                                <p class="link_menu">{{$item->name}}</p>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- end sidebar --}}
    <!-- menu_bottom -->
    <div class="show_menu_bottom">
        <li class="icon_menu_bottom" id="show_menu_bottom">
            <i class="fa-solid fa-circle-chevron-up"></i>
        </li>
    </div>


    <!-- menu_bottom -->
    <div class="show_menu_bottom">
        <li class="icon_menu_bottom" id="show_menu_bottom">
            <i class="fa-solid fa-circle-chevron-up"></i>
        </li>
    </div>
    <div class="menu_bottom">
        <div class="list_menu_bottom">
            <div class="sub_menu_left">
                <li class="icon_menu_bottom" id="prev_scene">
                    <i class="fa-solid fa-backward"></i>
                </li>
                <li class="icon_menu_bottom" id="close_menu_bottom">
                    <i class="fa-solid fa-xmark"></i>
                </li>
            </div>
            <div class="sub_menu_center">
                @if($tour->setting_display->infor)
                <li class="icon_menu_bottom" id="icon_info">
                    <i class="fa-solid fa-circle-info"></i>
                </li>
                @endif
                @if($tour->setting_display->setting_map)
                <li class="icon_menu_bottom" id="icon_map">
                    <i class="fas fa-map"></i>
                </li>
                @endif
                @if($tour->setting_display->sound)
                <li class="icon_menu_bottom" id="icon_mute">
                    <i class="fas fa-volume-off"></i>
                </li>


                <li class="icon_menu_bottom" id="icon_unmute">
                    <i class="fas fa-volume-mute"></i>
                </li>
                @endif
                @if($tour->setting_display->show_hotspot)
                <li class="icon_menu_bottom" id="hotspot_Close">
                    <i class="fas fa-toggle-off"></i>
                </li>

                <li class="icon_menu_bottom" id="hotspot_open">
                    <i class="fas fa-toggle-on"></i>
                </li>
                @endif
                @if($tour->setting_display->rotate)
                <li class="icon_menu_bottom" id="icon_rotate">
                    <i class="fa-solid fa-rotate-right"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_unrotate">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </li>
                @endif
                @if($tour->setting_display->setting_vr)
                <li class="icon_menu_bottom" id="icon_VR">
                    <i class="fas fa-vr-cardboard"></i>
                </li>
                @endif
                <li class="icon_menu_bottom" id="show_thumbs">
                    <i class="fas fa-th-large"></i>
                </li>
            </div>
            <div class="sub_menu_right">
                @if($tour->setting_display->fullscreen)
                <li class="icon_menu_bottom" id="icon_fullscreen" onclick="toggleFullscreen()">
                    <i class="fa-solid fa-expand"></i>
                </li>
                @endif
                <li class="icon_menu_bottom" id="next_scene">
                    <i class="fa-solid fa-forward"></i>
                </li>
            </div>
        </div>
    </div>
    <!--  -->
    <ul class="hide_show_menusub">
        <li class="item_icon" id="icon_menusub">
            <i class="fas fa-ellipsis-v"></i>
        </li>
        <ul class="menu_sub">
            @if($tour->setting_display->contact)
            <li class="item_icon" id="icon_form">
                <i class="fas fa-address-book"></i>
                <ul class="sub_action">
                    <li class="sub_action_item">
                        <p class="sub_action_link" target="_blank">Liên hệ</p>
                    </li>
                </ul>
            </li>
            @endif
            @if($tour->setting_display->guide)
            <li class="item_icon" id="icon_guide">
                <i class="fas fa-question"></i>
                <ul class="sub_action">
                    <li class="sub_action_item">
                        <p class="sub_action_link" target="_blank">Hướng dẫn</p>
                    </li>
                </ul>
            </li>
            @endif
            @if($tour->setting_display->share)
            <li class="item_icon" id="icon_sharelink">
                <i class="fas fa-share-alt"></i>
                <ul class="sub_action">
                    <li class="sub_action_item">
                        <p class="sub_action_link" target="_blank">Sao chép link</p>
                    </li>
                </ul>
            </li>
            @endif
            <li class="item_icon" id="icon_mute1">
                <i class="fas fa-volume-off"></i>
                <ul class="sub_action">
                    <li class="sub_action_item">
                        <p class="sub_action_link" target="_blank">Tắt âm thanh</p>
                    </li>
                </ul>
            </li>
            <li class="item_icon" id="icon_unmute1">
                <i class="fas fa-volume-mute"></i>
                <ul class="sub_action">
                    <li class="sub_action_item">
                        <p class="sub_action_link" target="_blank">Mở âm thanh</p>
                    </li>
                </ul>
            </li>
            <li class="item_icon" id="icon_rotate1">
                <i class="fa-solid fa-rotate-right"></i>
            </li>
            <li class="item_icon" id="icon_unrotate1">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </li>
        </ul>
    </ul>
    <!-- menu icon right -->

    <!-- form map, info dự án -->
    <div class="menu_icon">
        <div class="map">
            <div class="container">
                <div class="map_tour">
                    <iframe src="tour360/{{ $tour->code }}/map" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen frameborder="0"></iframe>
                    <span class="button_close btn_close_map" id="close_general" onclick="close_info()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        </div>


        <!-- form info Trà Loại 1 2 3 -->
        <div class="info_information" id="info_information">
            <div class="container">
                <div class="info_general ">
                    <h5 id="title_info_general"></h5>
                    <div class="content_general ">
                        <ul class="list_general">
                            <span id="content_info_general">
                            </span>
                        </ul>
                    </div>
                    <div class="footer_general ">
                        <div class="footer_general_image" id="voice_general">
                            <a href="https://voso.vn/" class="link_cart" target="_blank">
                                <i class="fa-solid fa-cart-arrow-down icon_play"></i>
                                Giỏ hàng
                            </a>

                        </div>
                        <div class="footer_general_image" onclick="show_image()" id="image_general">
                            Hình ảnh
                            <i class="fa-solid fa-image icon_image"></i>
                        </div>

                    </div>
                    <span class="button_close" id="close_general" onclick="close_info()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>

            </div>
        </div>
        <div class="image_tra" id="image_tra">
            <div class="container">
                <div class="info_image">
                    <div class="row_info_image">
                        <div class="col_info_image ">
                            <img src="assets/img/image_2.jpg" class="img-fluid  d-block item_img_tra" alt="">
                            <span class="item_title_img">Hình ảnh sản phẩm</span>
                        </div>
                        <div class="col_info_image">
                            <img src="assets/img/image_3.jpg" class="img-fluid d-block item_img_tra" alt="">
                            <span class="item_title_img">Chứng nhận sản phẩm</span>
                        </div>
                    </div>
                    <span class="button_close" id="close_image" onclick="close_info_tra()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        <!-- form info dự án tổng thể  -->
        <div class="info">
            <div class="container">
                <div class="form-project">
                    <h5 class="title_form_project">Giới Thiệu chung về </h5>
                    <div class="content-form">
                        @foreach ($tour->infors as $info )
                        <span class="info_link"
                            onclick="show_info_content({{$info->id}}); @if($info->voice_active) setDataPlayAudio({{ $info->id }},'{{ $info->voice_active->voice}}') @endif ">
                            {{ $info->title }}
                        </span>
                        @endforeach
                    </div>
                    <span class="button_close" id="close_info">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        @foreach ($tour->infors as $info )
        <div class="info_duan info_duan_{{ $info->id }}" id="info_duan_{{ $info->id }}">
            <div class="container">
                <div class="info_general ">
                    <h5 id="title_info_duan">{{ $info->title }}</h5>
                    <div class="content_general ">
                        <ul class="list_general">
                            <span id="content_info_duan">
                                {!! $info->description_vn !!}
                            </span>
                        </ul>
                    </div>
                    <div class="footer_general ">
                        @if($info->voice_active)
                        <div class="footer_general_image"
                            onclick="playAudio({{ $info->id }},'{{ $info->voice_active->voice}}')">
                            <i class="fa-solid fa-play icon_play icon_play_{{ $info->id }}"></i>
                            Nghe
                        </div>
                        @endif
                        <div class="footer_general_image" onclick="show_image_duan({{ $info->id }})" id="image_general">
                            Hình ảnh
                            <i class="fa-solid fa-image icon_image"></i>
                        </div>
                    </div>
                    <span class="button_close" id="close_general" onclick="close_duan({{ $info->id }})">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="info_infomation_image" id="info_infomation_image_{{ $info->id }}">
            <div class="container">
                <div class="info_image">
                    <div class="row_info_image">
                        @foreach ($info->images as $image)
                        <div class="col_info_image">
                            <img src="{{ $image->image }}" id="image_info_left" class="img-fluid" alt="">
                        </div>
                        @endforeach

                    </div>

                    <div class="title_image_info">
                        <span>{{ $info->title }}</span>
                    </div>
                    <span class="button_close" id="close_image" onclick="close_image_duan({{ $info->id }})">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>

        </div>
        @endforeach

        <div class="guide">
            <div class="container">
                <div class="guide_tour">
                    <div class="title_guide">
                        <h5>Hướng dẫn</h5>
                    </div>

                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="assets/img/help_guide.png" class="img_guide" class="img-fluid" alt="">
                                </td>
                                <td>
                                    <div class="form_guide_text">1. Click giữ vào ảnh rồi kéo về phía cần xem.<br>
                                        2. Đưa con trỏ chuột vào các điểm được đánh dấu để xem trước thông tin các địa
                                        điểm khác, click vào để chuyển đến địa điểm tương ứng<br>
                                        3. Sử dụng thanh menu phía dưới để khai thác các tính năng khác.</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="button_close" id="close_general" onclick="close_info()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="form" id="form">
            <div class="container">
                <div class="form_contact">
                    <div class="contact">
                        <h3 class="title_contact">Contact Us</h3>
                        <form id="contact-form">
                            <input type="hidden" name="_token" value="2d7EP09QskNLTOighldVx0TZxQ3ae1iotrMIeMfq">
                            <div class="form-group ">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="form-group ">
                                <input type="text" name="email" id="phone" class="form-control"
                                    placeholder="Your Email Address">
                            </div>
                            <div class="form-group ">
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Your Phone Number">
                            </div>
                            <div class="form-group ">
                                <textarea class="form-control" name="message" id="message"
                                    placeholder="Type your mesage here.." rows="5" cols="4"></textarea>
                            </div>
                            <div style="text-align:center">
                                <button type="submit" class=" btn-sub text-uppercase">Submit</button>
                            </div>
                        </form>
                    </div>
                    <span class="button_close" id="close_general" onclick="close_info()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <!-- popup -->
    <div class="popup" id="popup_">
        <div class="container">
            <div class="form_popup">
                <div class="list_form_popup">
                    <div class="header_popup">
                        <h5 id="title_form"></h5>
                    </div>
                    <div class="content_popup">
                        <div id="content_form">

                        </div>
                    </div>
                    <span class="button_close" id="close">
                        <i class="fas fa-times"></i>

                    </span>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
   var tour = {!! json_encode($tour) !!}
   var list_hotspot = {!! json_encode($list_hotspot_first) !!}
    console.log(tour.path);
</script>
@endsection
