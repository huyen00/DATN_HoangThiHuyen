@extends('tour360.layout.index')
@section('title', $tour->name)
@section('image',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->thumb : null))
@section('icon',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->favicon : null))

@section('content')
<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
</div>

<div class="setting_vr">
    @if($tour->setting_display->setting_vr)
	<li class="icon_menu_bottom" id="icon_VR" >
		<img src="/assets/img/vr_btn.png" alt="">
	</li>
    @endif
</div>
<!-- bottom -->
<div class="icon_menu">
	<li>
		<i class="fa-solid fa-bars"></i>
	</li>
</div>
<div class="background_sound"></div>
<div class="menu_right">
	<div class="list_menu_right">
        @if($tour->setting_display->sound)
		<li class="item_menu_right" id="icon_mute" aria-label="Tắt âm thanh" data-balloon-pos="left">
			<i class="fas fa-volume-off "></i>
		</li>
		<li class="item_menu_right" id="icon_unmute" aria-label="Mở âm thanh" data-balloon-pos="left">
			<i class="fas fa-volume-mute"></i>
		</li>
        @endif
		<li class="item_menu_right icon_setting" id="icon_setting" aria-label="Cài đặt" data-balloon-pos="left">
			<i class="fas fa-cog "></i>
			<ul class="list_setting">
				<h5 class="title_setting">Nhạc nền</h5>
				<li class="item_setting" id="sound1">
					<span>Nhạc nền 1</span>
				</li>
				<li class="item_setting" id="sound2">
					<span>Nhạc nền 2</span>
				</li>
				<h5 class="title_setting">Tắt/Bật hotspot</h5>
                @if($tour->setting_display->show_hotspot)
				<li class="item_setting" id="text_hotspot_Close" >
					<span>Tắt hotspot</span>
				</li>
				<li class="item_setting" id="text_hotspot_open">
					<span>Bật hotspot</span>
				</li>
                @endif
			</ul>
		</li>

		@if($tour->setting_display->rotate)
		<li class="item_menu_right" id="icon_rotate" aria-label="Tắt xoay" data-balloon-pos="left">
			<i class="fa-solid fa-rotate-right"></i>
		</li>
		<li class="item_menu_right" id="icon_unrotate" aria-label="Bật xoay" data-balloon-pos="left" >
			<i class="fa-solid fa-clock-rotate-left"></i>
		</li>
        @endif
        @if($tour->setting_display->guide)
		<li class="item_menu_right" id="icon_guide" aria-label="Hướng dẫn" onclick="show_guide()" data-balloon-pos="left">
			<i class="fa-solid fa-question"></i>
		</li>
        @endif
        @if($tour->setting_display->fullscreen)
		<li class="item_menu_right" id="icon_fullscreen" onclick="toggleFullscreen()" aria-label="Full màn hình" data-balloon-pos="left">
			<i class="fas fa-expand "></i>
		</li>
        @endif
        @if($tour->setting_display->share)
		<li class="item_menu_right" id="icon_sharelink" aria-label="Sao chép link" data-balloon-pos="left">
			<i class="fas fa-share-alt"></i>
		</li>
        @endif
	</div>

</div>
<div class="menu_bottom">
	<div class="list_menu_bottom">
		<li class="item_menu_bottom item_tongthe" id="{{ count($tour->panos) >0 ? $tour->panos[0]->id_thumb :null }}">
			<img src="/assets/img/tongthe.png" class="image_menu" alt="">
			<span class="title_icon_menu">Tổng thể</span>
		</li>
        @if($tour->setting_display->infor)
		<li class="item_menu_bottom" id="icon_info" onclick="show_info()">
			<img src="/assets/img/info.png" class="image_menu" alt="">
			<span class="title_icon_menu">Thông tin</span>
		</li>
        @endif
		<li class="item_menu_bottom" id="show_thumbs">
			<img src="/assets/img/tienich.png" class="image_menu" alt="">
			<span class="title_icon_menu">Tiện ích</span>
		</li>
        @if($tour->setting_display->setting_map)
		<li class="item_menu_bottom" id="icon_map" onclick="show_map()">
			<img src="/assets/img/map.png" class="image_menu" alt="">
			<span class="title_icon_menu">Bản Đồ</span>
		</li>
        @endif
        @if($tour->setting_display->contact)
		<li class="item_menu_bottom" id="icon_contact" onclick="show_contact()">
			<img src="/assets/img/map.png" class="image_menu" alt="">
			<span class="title_icon_menu">Liên hệ</span>
		</li>
        @endif

	</div>
</div>

<div class="menu_bottom_thumb" id="thumb">
	<div class="owl-carousel owl-theme list_thumb">
		@foreach ($tour->panos as $key=>$pano)
		<div class="item @if($key == 0) active @endif {{ $pano->id_thumb }}" id="{{ $pano->id_thumb }}">
			<img src="/{{ $pano->thumb_img }}" class="img_thumb" alt="">
			<div class="content-thumb ">
				<span class="title-thumb">{{ $pano->name }} </span>
			</div>

		</div>
		@endforeach
	</div>
</div>

<!-- form info tong quat -->
<div class="general_info" id="general_info">
	<span class="button_close" id="close_general" onclick="close_form()">
		<i class="fas fa-times"></i>
	</span>
	<div class="form_general_info">
		<h5>Giới Thiệu Chung Về</h5>
		<div class="content_general_info">
			<div class="content_general">
				@foreach ($tour->infors as $info )
				<span  class="info_link"  onclick="show_item_info({{$info->id}}); @if($info->voice_active) setDataPlayAudio({{ $info->id }},'{{ $info->voice_active->voice}}') @endif ">
					{{ $info->title }}
				</span>
				@endforeach
			</div>

		</div>
	</div>
</div>
<!-- form info -->
@foreach ($tour->infors as $info )
<div class="info info_{{ $info->id }}" id="info_{{ $info->id }}">
	<span class="button_close" id="close_general" onclick="close_item_info({{ $info->id }})">
		<i class="fas fa-times"></i>
	</span>
	<div class="form_info">
		<div class="title_info">
			<h5 id="title_info" >{{ $info->title }}</h5>
		</div>
		<div class="content_info">
			<div class="text_content_info" id="text_content_info">
				{!! $info->description_vn !!}
			</div>
		</div>
		<div class="footer_info">
			@if($info->voice_active)
			<div class="footer_icon" id="footer_voice"
				onclick="playAudio({{ $info->id }},'{{ $info->voice_active->voice}}')">
				<i class="fa-solid fa-play icon_play icon_play_{{ $info->id }}"></i>
				Nghe
			</div>
			@endif
			<div class="footer_icon" onclick="show_image({{ $info->id }})" id="footer_image">
				Hình ảnh
				<i class="fa-solid fa-image icon_image"></i>
			</div>
		</div>
	</div>
</div>
	<!-- image -->
	<div class="image" id="image_{{ $info->id }}">
		<span class="button_close" id="close_general" onclick="close_image({{ $info->id }})">
			<i class="fas fa-times"></i>
		</span>
		<div class="form_image">
			<div class="row list_image">
				@foreach ($info->images as $image)
				<div class="item_image">
					<img src="/{{ $image->image }}" class="img-fluid img_album" alt="">
					<div class="title_image">
						<span>{{ $image->name }}</span>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
@endforeach

<!-- map -->

<div class="map" id="map">
	<span class="button_close" id="close_general" onclick="close_form()">
		<i class="fas fa-times"></i>
	</span>
	<div class="form_map">
		<iframe src="/tour/{{ $tour->code }}/map" class="iframe_map" frameborder="0"
		allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
		allowfullscreen frameborder="0"></iframe>
	</div>
</div>
<!-- contact -->
<div class="contact" id="contact">
	<div class="form_contact">
		<h3 class="title_contact">Liên Hệ </h3>
		<form id="contact-form" >
			<input type="hidden" name="_token" value="2d7EP09QskNLTOighldVx0TZxQ3ae1iotrMIeMfq">
			<div class="form-group ">
				<input type="text" name="name" id="name" class="form-control" placeholder="Tên ">
			</div>
			<div class="form-group ">
				<input type="text" name="email" id="phone" class="form-control" placeholder="Địa chỉ email">
			</div>
			<div class="form-group ">
				<input type="text" name="phone" id="phone" class="form-control" placeholder="Số điện thoại">
			</div>
			<div class="form-group ">
				<textarea class="form-control" name="message" id="message" placeholder="Tin nhắn..." rows="3" cols="4"></textarea>
			</div>
			<div style="text-align:center">
				<button type="submit" class=" btn-sub text-uppercase">Gửi cho chúng tôi</button>
			</div>
		</form>
	</div>
	<span class="button_close" id="close_general" onclick="close_form()">
		<i class="fas fa-times"></i>
	</span>
</div>
{{-- form info hotspot --}}
<div class="info_hotspot" id="info_hotspot">
<span class="button_close" id="close_info_hotspot" onclick="close_info_hotspot()">
	<i class="fas fa-times"></i>
</span>
<div class="form_info">
	<div class="title_info">
		<h5 id="title_info" ></h5>
	</div>
	<hr class="line">
	<div class="content_info">
		<div class="text_content_info" id="text_content_info">

		</div>
	</div>
	<div class="footer_info">
		<div class="footer_icon" id="footer_voice">
			<i class="fa-solid fa-play icon_play"></i>
			<i class="fa-solid fa-pause icon_pause "></i>

			Nghe
		</div>
		<div class="footer_icon" onclick="show_image_hotspot()" id="footer_image">
			Hình ảnh
			<i class="fa-solid fa-image icon_image"></i>
		</div>
	</div>
</div>
</div>

<!-- image hotspot -->
{{-- <div class="image_hotspot" id="image_hotspot">
	<span class="button_close" id="close_general" onclick="close_image_hotspot()">
		<i class="fas fa-times"></i>
	</span>
	<div class="form_image">
		<div class="row list_image">
			<div class="item_image">
				<img src="panos/1_flycam1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Toàn cảnh 01</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/15_nguyenlieua1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu nguyên liệu A1</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/2_nguyenlieua2.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu nguyên liệu A2</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/3_nguyenlieua4.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu nguyên liệu A3</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/13_khunguyenlieub1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu nguyên liệu B1</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/4_nguyenlieub6.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu nguyên liệu B2</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/5_khusxcayduoclieu.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu nhà trưng bày</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/6_traloai1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>Khu trưng bày dược liệu</span>
				</div>
			</div>
			<div class="item_image">
				<img src="panos/7_traloai2.tiles/thumb.jpg" class="img-fluid img_album" alt="">
				<div class="title_image">
					<span>khu trưng bày trà Loại 2</span>
				</div>
			</div>
		</div>
	</div>
</div> --}}
{{-- guide --}}
<div class="guide" id="guide">
	<span class="button_close" id="close_general" onclick="close_guide()">
		<i class="fas fa-times"></i>
	</span>
	<div class="guide_tour"  >
		<div class="title_guide">
			<h5>Hướng dẫn</h5>
		</div>
		<table>
			<tbody>
				<tr>
					<td>
						<img src="" class="img_guide"  class="img-fluid" alt="">
					</td>
					<td>
						<div class="form_guide_text">1. Click giữ vào ảnh rồi kéo về phía cần xem.<br>
								   2. Đưa con trỏ chuột vào các điểm được đánh dấu để xem trước thông tin các địa điểm khác,        click vào để chuyển đến địa điểm tương ứng<br>
								3. Sử dụng thanh menu phía dưới để khai thác các tính năng khác.</div>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var tour = {!! json_encode($tour) !!}
	var list_hotspot = {!! json_encode($list_hotspot_first) !!}
	var editor = {!! json_encode($isEditor) !!}
    var check_info = {!! json_encode($tour->infors) !!}
    var check_info_number = check_info.length;
</script>
