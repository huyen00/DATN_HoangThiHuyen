
<?php $__env->startSection('title', $tour->name); ?>
<?php $__env->startSection('image',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->thumb : null)); ?>
<?php $__env->startSection('icon',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->favicon : null)); ?>

<?php $__env->startSection('content'); ?>
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

    <div class="thumblist">
        <div class="owl-carousel owl-theme" id=" thumbs">
            <?php $__currentLoopData = $tour->panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item  <?php if($key == 0): ?> active <?php endif; ?> <?php echo e($pano->id_thumb); ?>" id="<?php echo e($pano->id_thumb); ?>">
                <img src="<?php echo e($pano->thumb_img); ?>" class="img-thumb" alt="">
                <div class="content-thumb ">
                    <span class="title-thumb"><?php echo e($pano->name); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="menu_list">
        <div class="list_title">
            <div class="title_catagory" id="title_1" >
                <div class="icon_plus">
                    <i class="fa-solid fa-plus icon_open" id="icon_1"></i>
                </div>
                <div class="text_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
            </div>

            <div class="content_catagory" id="content_1">
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
            </div>
        </div>
        <div class="list_title">
            <div class="title_catagory" id="title_2" >
                <div class="icon_plus">
                    <i class="fa-solid fa-plus icon_open" id="icon_2"></i>
                </div>
                <div class="text_catagory">
                    <span>Điện Tam Thế</span>
                </div>
            </div>

            <div class="content_catagory" id="content_2">
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
            </div>
        </div>
        <div class="list_title">
            <div class="title_catagory" id="title_3" >
                <div class="icon_plus">
                    <i class="fa-solid fa-plus icon_open" id="icon_3"></i>
                </div>
                <div class="text_catagory">
                    <span>Điện Quán Âm</span>
                </div>
            </div>

            <div class="content_catagory" id="content_3">
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
                <div class="title_content_catagory">
                    <span>Chùa Tam Chúc</span>
                </div>
            </div>
        </div>
    </div>
    <div class="menu_list_mobile">
        <div class="list_title_mobile">
            <div class="title_catagory_mobile" id="title_4" >
                <div class="icon_plus_mobile">
                    <i class="fa-solid fa-plus icon_open_mobile" id="icon_4"></i>
                </div>
                <div class="text_catagory_mobile">
                    <span>Tam Chúc</span>
                </div>
            </div>

            <div class="content_catagory_mobile" id="content_4">
                <div class="catagory_mobile">
                    <h6 class="   title_mobile">Cổng Tam Quan</h6>

                    <div class="title_content_catagory_mobile">
                        <span>Chùa Tam Chúc</span>
                    </div>
                    <div class="title_content_catagory_mobile">
                        <span>Chùa Tam Chúc</span>
                    </div>
                </div>
                <div class="catagory_mobile">
                    <h6 class="   title_mobile">Điện Quán Âm</h6>

                    <div class="title_content_catagory_mobile">
                        <span>Chùa Tam Chúc</span>
                    </div>
                    <div class="title_content_catagory_mobile">
                        <span>Chùa Tam Chúc</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- menu_bottom -->
    <div class="show_menu_bottom">
        <li class="icon_menu_bottom" id="show_menu_bottom" aria-label="Hiện menu" data-balloon-pos="up">
            <i class="fa-solid fa-circle-chevron-up"></i>
        </li>
    </div>
    <div class="background_sound"></div>
    <div class="menu_bottom">
        <div class="list_menu_bottom">
            <div class="sub_menu_left">
                <li class="icon_menu_bottom" id="prev_scene" aria-label="Quay lại" data-balloon-pos="up">
                    <i class="fa-solid fa-backward"></i>
                </li>
                <li class="icon_menu_bottom" id="close_menu_bottom" aria-label="Ẩn menu" data-balloon-pos="up">
                    <i class="fa-solid fa-xmark"></i>
                </li>
            </div>
            <div class="sub_menu_center">
                <?php if($tour->setting_display->infor): ?>
                <li class="icon_menu_bottom" id="icon_info" aria-label="Thông tin" data-balloon-pos="up" onclick="show_info()">
                    <i class="fa-solid fa-circle-info"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->setting_map): ?>
                <li class="icon_menu_bottom" id="icon_map" aria-label="Map" data-balloon-pos="up" onclick="show_map()">
                    <i class="fa-solid fa-location-dot"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->sound): ?>
                <div class="icon_menu_bottom icon_voice" >
                    <li class="" id="icon_mute" >
                        <i class="fas fa-volume-off"></i>

                    </li>
                    <div class="change_sound" id="change_sound">
                        <li class="item_sound" id="sound1">
                            <span>Nhạc nền 1</span>
                        </li>
                        <li class="item_sound" id="sound2">
                            <span>Nhạc nền 2</span>
                        </li>
                        <li class="item_sound" id="text_unmute">
                            <span>Tắt âm thanh</span>
                        </li>
                        <li class="item_sound" id="text_mute">
                            <span>Bật âm thanh</span>
                        </li>
                    </div>

                    <li class="" id="icon_unmute" >
                        <i class="fas fa-volume-mute"></i>

                    </li>
                </div>

                <?php endif; ?>
                <?php if($tour->setting_display->show_hotspot): ?>
                <li class="icon_menu_bottom" id="hotspot_Close" aria-label="Ẩn hotspot" data-balloon-pos="up">
                    <i class="fas fa-toggle-off"></i>
                </li>

                <li class="icon_menu_bottom" id="hotspot_open" aria-label="Hiện hotspot" data-balloon-pos="up">
                    <i class="fas fa-toggle-on"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->rotate): ?>
                <li class="icon_menu_bottom" id="icon_rotate" aria-label="Tắt xoay" data-balloon-pos="up">
                    <i class="fa-solid fa-rotate-right"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_unrotate" aria-label="Mở xoay" data-balloon-pos="up">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->setting_vr): ?>
                <li class="icon_menu_bottom" id="icon_VR" aria-label="VR" data-balloon-pos="up">
                    <i class="fas fa-vr-cardboard"></i>
                </li>
                <?php endif; ?>
                <li class="icon_menu_bottom" id="show_thumbs" aria-label="Thumbs" data-balloon-pos="up">
                    <i class="fas fa-th-large"></i>
                </li>
            </div>
            <div class="sub_menu_right">
                <?php if($tour->setting_display->fullscreen): ?>
                <li class="icon_menu_bottom" id="icon_fullscreen" onclick="toggleFullscreen()"
                    aria-label="Full màn hình" data-balloon-pos="up">
                    <i class="fa-solid fa-expand"></i>
                </li>
                <?php endif; ?>
                <li class="icon_menu_bottom" id="next_scene" aria-label="Đi tiếp" data-balloon-pos="up">
                    <i class="fa-solid fa-forward"></i>
                </li>
            </div>
        </div>
    </div>
    <!--  -->
    <ul class="hide_show_menusub">
        <li class="item_icon" id="icon_menusub_template5">
            <i class="fas fa-ellipsis-v"></i>
        </li>
        <ul class="menu_sub menu_sub_template1" id="menu_sub_template5">
            <?php if($tour->setting_display->contact): ?>
            <li class="item_icon" id="icon_contact" aria-label="Liên hệ" data-balloon-pos="left" onclick="show_contact()">
                <i class="fas fa-address-book"></i>
            </li>
            <?php endif; ?>
            <?php if($tour->setting_display->guide): ?>
            <li class="item_icon" id="icon_guide" aria-label="Hướng dẫn" data-balloon-pos="left" onclick="show_guide()">
                <i class="fas fa-question"></i>
            </li>
            <?php endif; ?>
            <?php if($tour->setting_display->share): ?>
            <li class="item_icon" id="icon_sharelink" aria-label="Sao chép link" data-balloon-pos="left">
                <i class="fas fa-share-alt"></i>
            </li>
            <?php endif; ?>
            <li class="item_icon" id="icon_mute1" aria-label="Tắt âm thanh" data-balloon-pos="left">
                <i class="fas fa-volume-off"></i>
            </li>
            <li class="item_icon" id="icon_unmute1" aria-label="Mở âm thanh" data-balloon-pos="left">
                <i class="fas fa-volume-mute"></i>
            </li>
            <li class="item_icon" id="icon_rotate1" aria-label="Tắt xoay" data-balloon-pos="left">
                <i class="fa-solid fa-rotate-right"></i>
            </li>
            <li class="item_icon" id="icon_unrotate1" aria-label="Mở xoay" data-balloon-pos="left">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </li>
        </ul>
    </ul>



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
                <?php $__currentLoopData = $tour->infors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span  class="info_link"  onclick="show_item_info(<?php echo e($info->id); ?>); <?php if($info->voice_active): ?> setDataPlayAudio(<?php echo e($info->id); ?>,'<?php echo e($info->voice_active->voice); ?>') <?php endif; ?> ">
                    <?php echo e($info->title); ?>

                </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>
</div>
<!-- form info -->
<?php $__currentLoopData = $tour->infors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="info info_<?php echo e($info->id); ?>" id="info_<?php echo e($info->id); ?>">
    <span class="button_close" id="close_general" onclick="close_item_info(<?php echo e($info->id); ?>)">
        <i class="fas fa-times"></i>
    </span>
    <div class="form_info">
        <div class="title_info">
            <h5 id="title_info" ><?php echo e($info->title); ?></h5>
        </div>
        <div class="content_info">
            <div class="text_content_info" id="text_content_info">
                <?php echo $info->description_vn; ?>

            </div>
        </div>
        <div class="footer_info">
            <?php if($info->voice_active): ?>
            <div class="footer_icon" id="footer_voice"
                onclick="playAudio(<?php echo e($info->id); ?>,'<?php echo e($info->voice_active->voice); ?>')">
                <i class="fa-solid fa-play icon_play icon_play_<?php echo e($info->id); ?>"></i>
                Nghe
            </div>
            <?php endif; ?>
            <div class="footer_icon" onclick="show_image(<?php echo e($info->id); ?>)" id="footer_image">
                Hình ảnh
                <i class="fa-solid fa-image icon_image"></i>
            </div>
        </div>
    </div>
</div>
    <!-- image -->
    <div class="image" id="image_<?php echo e($info->id); ?>">
        <span class="button_close" id="close_general" onclick="close_image(<?php echo e($info->id); ?>)">
            <i class="fas fa-times"></i>
        </span>
        <div class="form_image">
            <div class="row list_image">
                <?php $__currentLoopData = $info->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item_image">
                    <img src="<?php echo e($image->image); ?>" class="img-fluid img_album" alt="">
                    <div class="title_image">
                        <span><?php echo e($image->name); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- map -->

<div class="map" id="map">
    <span class="button_close" id="close_general" onclick="close_form()">
        <i class="fas fa-times"></i>
    </span>
    <div class="form_map">
        <iframe src="tour360/<?php echo e($tour->code); ?>/map" class="iframe_map" frameborder="0"
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
</div>

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
<div class="image_hotspot" id="image_hotspot">
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
</div>
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

<script>
    var tour = <?php echo json_encode($tour); ?>

	var list_hotspot = <?php echo json_encode($list_hotspot_first); ?>

    var editor = <?php echo json_encode($isEditor); ?>

</script>
<script>
     $(document).ready(function(){
         $('.owl-carousel').owlCarousel({
             margin:10,
             nav:true,
             responsive:{
                 0:{
                     items:1
                 },
                 320:{
                   items:2
                 },
                 480:{
                   item:3
                 },
                 600:{
                     items:6
                 },
                 1000:{
                     items:12
                 }
             }
         });

         $(".title_catagory").click(function(){
            $(".content_catagory").slideToggle();
        });

        $(".title_catagory").click(function(event){
            var id = $(this).attr("id").split('_')[1];

            $(".content_catagory").hide();
            $(`#icon_${id}`).toggleClass("icon_add");
            $(`#content_${id}`).show();

        });

        // Mobile
        $(".title_catagory_mobile").click(function(){
            $(".content_catagory_mobile").slideToggle();
        });

        $(".title_catagory_mobile").click(function(event){
            var id = $(this).attr("id").split('_')[1];

            $(".content_catagory_mobile").hide();
            $(`#icon_${id}`).toggleClass("icon_add");
            $(`#content_${id}`).show();

        });
        $("#icon_menusub_template5").click(function(){
            $("#menu_sub_template5").slideToggle();
        });


     });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tour360.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Holo360\resources\views\template\template5.blade.php ENDPATH**/ ?>