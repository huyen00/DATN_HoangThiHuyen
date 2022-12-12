
<?php $__env->startSection('title', $tour->name); ?>
<?php $__env->startSection('image',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->thumb : null)); ?>

<?php $__env->startSection('content'); ?>
<div id="pano" style="width:100%;height:100%;">
	<noscript>
        <table style="width:100%;height:100%;">
            <tr style="vertical-align:middle;"><td>
                <div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/>
                </div></td>
            </tr>
        </table>
    </noscript>
    
    	<div class="logo_tour "  >
            <img src="<?php echo e(($tour->setting_tour != null ) ? $tour->setting_tour->logo : null); ?>" class="img-fluid " alt="">
            <li class="logo_ocop">
                Doanh nghiệp OCOP 4 *
            </li>
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
				<img src="<?php echo e(($tour->setting_tour != null ) ? $tour->setting_tour->logo : null); ?>" class="img-fluid" alt="">
				<li class="slider_logo_ocop">
					Doanh nghiep OCOP 4*
				</li>
			</div>
			<div class="menu_sub_slider">
				<ul class="sub_slider">
					<?php $__currentLoopData = $tour_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_title => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="item_menu">
                        <h2 class=" title_menu"><?php echo e($group_title); ?> </h2>
                        <ul>
                            <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="item_sub  <?php echo e($item->id_thumb); ?>" id="<?php echo e($item->id_thumb); ?>">
                                <p  class="link_menu"><?php echo e($item->name); ?></p>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
	</div>
    
    <!-- menu_bottom -->
    <div class="show_menu_bottom">
        <li class="icon_menu_bottom" id="show_menu_bottom">
            <i class="fa-solid fa-circle-chevron-up"></i>
        </li>
    </div>
    
    <div class="thumblist">
        <div class="list-thumbs " data-sizes="100vw" id=" thumbs">
            <?php $__currentLoopData = $tour->panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item-thumbs <?php if($key == 0): ?> active <?php endif; ?> <?php echo e($pano->id_thumb); ?>" id="<?php echo e($pano->id_thumb); ?>">
                    <img src="<?php echo e($pano->thumb_img); ?>" class="img-thumb" alt="">
                    <div class="content-thumb ">
                        <span class="title-thumb"><?php echo e($pano->name); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
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
                        <?php if($tour->setting_display->infor): ?>
                            <li class="icon_menu_bottom" id="icon_info">
                                <i class="fa-solid fa-circle-info"></i>
                            </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->setting_map): ?>
                        <li class="icon_menu_bottom" id="icon_map">
                            <i class="fas fa-map"></i>
                        </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->sound): ?>
                        <li class="icon_menu_bottom" id="icon_mute">
                            <i class="fas fa-volume-off"></i>
                        </li>


                        <li class="icon_menu_bottom" id="icon_unmute">
                            <i class="fas fa-volume-mute"></i>
                        </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->show_hotspot): ?>
                        <li class="icon_menu_bottom" id="hotspot_Close">
                            <i class="fas fa-toggle-off"></i>
                        </li>

                        <li class="icon_menu_bottom" id="hotspot_open">
                            <i class="fas fa-toggle-on"></i>
                        </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->rotate): ?>
                        <li class="icon_menu_bottom" id="icon_rotate">
                            <i class="fa-solid fa-rotate-right"></i>
                        </li>
                        <li class="icon_menu_bottom" id="icon_unrotate">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->setting_vr): ?>
                        <li class="icon_menu_bottom" id="icon_VR">
                            <i class="fas fa-vr-cardboard"></i>
                        </li>
                        <?php endif; ?>
                        <li class="icon_menu_bottom" id="show_thumbs">
                            <i class="fas fa-th-large"></i>
                        </li>
                    </div>
                    <div class="sub_menu_right">
                        <?php if($tour->setting_display->fullscreen): ?>
                        <li class="icon_menu_bottom" id="icon_fullscreen" onclick="toggleFullscreen()">
                            <i class="fa-solid fa-expand"></i>
                        </li>
                        <?php endif; ?>
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
                        <?php if($tour->setting_display->contact): ?>
                        <li class="item_icon" id="icon_form">
                            <i class="fas fa-address-book"></i>
                            <ul class="sub_action">
                                <li class="sub_action_item">
                                    <p class="sub_action_link" target="_blank">Liên hệ</p>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->guide): ?>
                        <li class="item_icon" id="icon_guide">
                            <i class="fas fa-question"></i>
                            <ul class="sub_action">
                                <li class="sub_action_item">
                                    <p class="sub_action_link" target="_blank">Hướng dẫn</p>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($tour->setting_display->share): ?>
                        <li class="item_icon" id="icon_sharelink" >
                            <i class="fas fa-share-alt"></i>
                            <ul class="sub_action">
                                <li class="sub_action_item">
                                    <p class="sub_action_link" target="_blank">Sao chép link</p>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
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
                                <iframe src="tour360/<?php echo e($tour->code); ?>/map" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen frameborder="0"></iframe>
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
                                    <ul class="list_general" >
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
                                        <img src="assets/img/image_2.jpg"  class="img-fluid  d-block item_img_tra"  alt="">
                                        <span class="item_title_img">Hình ảnh sản phẩm</span>
                                    </div>
                                    <div class="col_info_image">
                                        <img src="assets/img/image_3.jpg"  class="img-fluid d-block item_img_tra"  alt="">
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

                                    <?php $__currentLoopData = $tour->infors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="info_link"
                                        onclick="show_info_content(<?php echo e($info->id); ?>); <?php if($info->voice_active): ?> setDataPlayAudio(<?php echo e($info->id); ?>,'<?php echo e($info->voice_active->voice); ?>') <?php endif; ?> ">
                                        <?php echo e($info->title); ?>

                                    </span>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <span class="button_close" id="close_info">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php $__currentLoopData = $tour->infors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="info_duan info_duan_<?php echo e($info->id); ?>" id="info_duan_<?php echo e($info->id); ?>">
                        <div class="container">
                            <div class="info_general ">
                                <h5 id="title_info_duan"><?php echo e($info->title); ?></h5>
                                <div class="content_general ">
                                    <ul class="list_general">
                                        <span id="content_info_duan">
                                            <?php echo $info->description_vn; ?>

                                        </span>
                                    </ul>
                                </div>
                                <div class="footer_general ">
                                    <?php if($info->voice_active): ?>
                                    <div class="footer_general_image"
                                        onclick="playAudio(<?php echo e($info->id); ?>,'<?php echo e($info->voice_active->voice); ?>')">
                                        <i class="fa-solid fa-play icon_play icon_play_<?php echo e($info->id); ?>"></i>
                                        Nghe
                                    </div>
                                    <?php endif; ?>
                                    <div class="footer_general_image" onclick="show_image_duan(<?php echo e($info->id); ?>)" id="image_general">
                                        Hình ảnh
                                        <i class="fa-solid fa-image icon_image"></i>
                                    </div>

                                </div>
                                <span class="button_close" id="close_general" onclick="close_duan(<?php echo e($info->id); ?>)">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="info_infomation_image" id="info_infomation_image_<?php echo e($info->id); ?>">
                        <div class="container">
                            <div class="info_image">
                                <div class="row_info_image">
                                    <?php $__currentLoopData = $info->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col_info_image">
                                        <img src="<?php echo e($image->image); ?>" id="image_info_left" class="img-fluid" alt="">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                                <div class="title_image_info">
                                    <span><?php echo e($info->title); ?></span>
                                </div>
                                <span class="button_close" id="close_image" onclick="close_image_duan(<?php echo e($info->id); ?>)">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                        </div>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    <div class="guide">
                        <div class="container">
                            <div class="guide_tour"  >
                                <div class="title_guide">
                                    <h5>Hướng dẫn</h5>
                                </div>

                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="assets/img/help_guide.png" class="img_guide"  class="img-fluid" alt="">
                                            </td>
                                            <td>
                                                <div class="form_guide_text">1. Click giữ vào ảnh rồi kéo về phía cần xem.<br>
                                                        2. Đưa con trỏ chuột vào các điểm được đánh dấu để xem trước thông tin các địa điểm khác,        click vào để chuyển đến địa điểm tương ứng<br>
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
                                    <form id="contact-form" >
                                        <input type="hidden" name="_token" value="2d7EP09QskNLTOighldVx0TZxQ3ae1iotrMIeMfq">
                                    <div class="form-group ">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
                                    </div>
                                    <div class="form-group ">
                                        <input type="text" name="email" id="phone" class="form-control" placeholder="Your Email Address">
                                    </div>
                                    <div class="form-group ">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone Number">
                                    </div>
                                    <div class="form-group ">
                                        <textarea class="form-control" name="message" id="message" placeholder="Type your mesage here.." rows="5" cols="4"></textarea>
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

var tour = <?php echo json_encode($tour); ?>

console.log(tour.path);
    // xử lý voice
(function ($) {
  embedpano({
      swf: "/" + tour.path + "/tour.swf",
      xml: "/" + tour.path + "/tour.xml",
      target: "pano",
      html5: "only",
      mobilescale: 1.0,
      passQueryParameters: true,
      onready: krpanoReady
  });

  function krpanoReady(krpano) {
      $("#icon_unmute").hide();
      $("#icon_unmute").on("click", function (e) {
          e.preventDefault();
          console.log(krpano);
          $("#icon_mute").show();
          $("#icon_unmute").hide();
          krpano.call("resumesound()");
      });
      $("#icon_mute").on("click", function (e) {
        e.preventDefault();
        console.log(krpano);
        $("#icon_unmute").show();
        $("#icon_mute").hide();
        krpano.call("pause_sound()");
    });
    // mute ở mobile
    $("#icon_unmute1").hide();
    $("#icon_unmute1").on("click", function (e) {
      e.preventDefault();
      console.log(krpano);
      $("#icon_mute1").show();
      $("#icon_unmute1").hide();
      krpano.call("resumesound()");
  });
  $("#icon_mute1").on("click", function (e) {
    e.preventDefault();
    console.log(krpano);
    $("#icon_unmute1").show();
    $("#icon_mute1").hide();
    krpano.call("pause_sound()");
  });
  // rotate mobile
  $("#icon_unrotate1").hide();
  $("#icon_rotate1").on("click",function(e){
    $("#icon_unrotate1").show();
    $("#icon_rotate1").hide();
    krpano.call("toggleRotate()");
  });
  $("#icon_unrotate1").on("click",function(e){
    $("#icon_unrotate1").hide();
    $("#icon_rotate1").show();
    krpano.call("toggleRotate()");
  });
  // menu_bottom
  $('.arrow-left').click(function(event){

		$(".menu_sliderbar").removeClass('show_menu_tour');
		$(".logo_tour").css("display","block");
		$(".logo_tour").addClass("transform_logo");
		$(".menu_sliderbar").toggleClass('hide_menu_tour');
		$('.arrow-right').show();
		$('.arrow-left').hide();
	});
	$('.arrow-right').click(function(event){
		$(".logo_tour").css("display","none");
		 $(".menu_sliderbar").removeClass('hide_menu_tour');
		$(".menu_sliderbar").toggleClass('show_menu_tour');
		$('.arrow-left').show();
		$('.arrow-right').hide();
	});
	$("#close_menu_bottom").click(function(){
		$(".menu_bottom").slideToggle();
		$(".thumblist").hide();
		$("#show_menu_bottom").show();
	});
	$("#show_menu_bottom").click(function(){
		$(".menu_bottom").slideToggle();
		$("#show_menu_bottom").hide();

	});
	$("#show_thumbs").click(function(){
		$(".thumblist").slideToggle();
	});

    // next scene
    $("#next_scene").click(function(){
		  krpano.call("nextscene()");
    });
    $("#prev_scene").click(function(){
		  krpano.call("prevscene()");
    });
    // xu ly VR
    $("#icon_VR").on("click", function(e){
      krpano.call("webvr.enterVR()");
    });
    // xử lý tắt bật xoay
    $("#icon_unrotate").hide();
    $("#icon_rotate").on("click",function(e){
      $("#icon_unrotate").show();
      $("#icon_rotate").hide();
      krpano.call("toggleRotate()");
    });
    $("#icon_unrotate").on("click",function(e){
      $("#icon_unrotate").hide();
      $("#icon_rotate").show();
      krpano.call("toggleRotate()");
    });

    // xu ly scene

    $("#icon_back").on("click",function(e){
      krpano.call("back_scene()");
    });
    // xu ly show/hide hotspot
    $("#hotspot_open").hide();
    $("#hotspot_Close").on("click",function(e){
      $("#hotspot_open").show();
      $("#hotspot_Close").hide();
      krpano.call("hideallhotspots()");
    });
    $("#hotspot_open").on("click",function(e){
      $("#hotspot_open").hide();
      $("#hotspot_Close").show();
      krpano.call("showallhotspot()");
    });
    $(".slick-slide.slick-current").click(function(e){
      // $(".slick-slide").addclass("slick-current");

      krpano.call("loadscene_with_name()");

    });

    // xu ly active khi click
  $(".item-thumbs").click(function(e){
    var link_scene = $(this).attr('id');
    console.log(link_scene);

    var elems = document.querySelectorAll(".active");
    [].forEach.call(elems, function(el) {
      el.classList.remove("active");

    });
    var elems = document.querySelectorAll(".active_menu");
      [].forEach.call(elems, function(el) {
        el.classList.remove("active_menu");

      });

    $(this).addClass("active");
    $(this).removeClass("active_menu");
    //console.log($(this).attr('id'));
    let target_active_menu = "#" + $(this).attr('id')
    var elems_active_menu = document.querySelectorAll(target_active_menu);
      [].forEach.call(elems_active_menu, function(el) {
        el.classList.add("active_menu");

      });
    krpano.call("load_scene(" +link_scene + ")");

  });

  // xu lys show scene menu
  $(".item_sub").click(function(e){
    var link_scene = $(this).attr('id');

    var elems = document.querySelectorAll(".active_menu");
    [].forEach.call(elems, function(el) {
      el.classList.remove("active_menu");

    });
    var elems_thumbs = document.querySelectorAll(".active");
    [].forEach.call(elems_thumbs, function(el) {
      el.classList.remove("active");

    });
    let target_active = "#" + $(this).attr('id');
    var elem_active = document.querySelectorAll(target_active);
    [].forEach.call(elem_active, function(el) {
      el.classList.add("active");

    });
    $(this).addClass("active_menu");
    $(this).removeClass("active");

    krpano.call("load_scene(" +link_scene + ")");
  });
  // xu ly minimap
  $(".panWrapper").mousedown(function(e){
    e.preventDefault();

   $(".panWrapper").hide();
    krpano.call("showmap()");

  });

  $("#icon_menusub").click(function(){
      $(".menu_sub").slideToggle();

    });
  var list_hotspot = [];
    var scene = [];
  $("#btn_Savexml").click(function(e)
  {
    var hotspot_count = krpano.get('hotspot.count');
    var index_scene = krpano.get('scene[get(xml.scene)].index');
    var scene_count = krpano.get('scene.count');
        for(i = 0; i < hotspot_count; i++){
            krpano.set('hotspot[' + i + '].alpha', 0.5);
            var hotspot = krpano.get('hotspot[ ' + i + ']');
                if(hotspot.url != null){
                    var hotspot_filter =
                    {
                        "name" : hotspot.name,
                        "ath" : hotspot.ath,
                        "atv" : hotspot.atv,
                        "url" : hotspot.url,
                        "style" : hotspot.style
                    };

                }else{
                    var hotspot_filter =
                    {
                        "name" : hotspot.name,
                        "style" : hotspot.style
                    };
                }
                list_hotspot.push(hotspot_filter);
        }
        scene[0]= {};
        scene[0]['id'] = index_scene;
        scene[0]['hotspot'] = list_hotspot;
    // }

    // console.log('list_hotspot',list_hotspot);
     console.log('scene',scene);

    var url_edit = "/tour_editor/" + tour.code;
    // console.log(url_edit);
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    // POST to server using $.post or $.ajax
    $.ajax({
        data: {
            scene: scene,
            },
        type: 'POST',
        url: `/tour_editor/${tour.code}`,
        error: function(err) {
            console.log(err);
        },
        success: function(data) {
            console.log(data);
        }
    });
  });
}

})(jQuery);
</script>
<script>
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myFunction(this);
        }
    };
    xhttp.open("GET", "tour2.xml", true);
    xhttp.send();

    function myFunction(xml) {
        var x, y, cloneNode, i, xmlDoc, txt;
        xmlDoc = xml.responseXML;
        txt = "";
        x = xmlDoc.getElementById('pano')[0];
        cloneNode = x.cloneNode(true);
        xmlDoc.documentElement.appendChild(cloneNode);

        // Output all titles
        y = xmlDoc.getElementsByTagName("title");
        for (i = 0; i < y.length; i++) {
            txt += y[i].childNodes[0].nodeValue + "<br>";
        }
        document.getElementById("demo").innerHTML = txt;
    }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tour360.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Holo360\resources\views\tour360\preview.blade.php ENDPATH**/ ?>