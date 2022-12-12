
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

    <div class="icon_menu">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="menu_icon_slidebar">
        <ul class="list_slidebar">
            <?php if($tour->setting_display->infor): ?>
            <li class="item_slidebar" id="icon_info" onclick="show_info()">
                <span class="title_slidebar" ><i class="fas fa-info-circle icon_slidebar"></i> Thông Tin </span>
            </li>
            <?php endif; ?>
            <?php if($tour->setting_display->setting_map): ?>
            <li class="item_slidebar" id="icon_map" onclick="show_map()" >
                <span class="title_slidebar" ><i class="fas fa-map-marker-alt icon_slidebar"></i> Bản Đồ</span>
            </li>
            <?php endif; ?>
            <li class="item_slidebar" id="icon_contact" onclick="show_contact()">
                <span class="title_slidebar"><i class="fas fa-address-book icon_slidebar"></i> Liên Hệ </span>
            </li>
            <?php if($tour->setting_display->show_hotspot): ?>
            <li class="item_slidebar" id="hotspot_Close" >
                <span class="title_slidebar"><i class="fas fa-toggle-on icon_slidebar"></i> Ẩn icon</span>
            </li>
            <li class="item_slidebar" id="hotspot_open">
                <span class="title_slidebar"><i class="fas fa-toggle-off icon_slidebar"></i> Hiện icon</span>
            </li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="menu_bottom">
        <div class="list_menu_bottom">
            <div class="sub_menu_left">
                <li class="icon_menu_bottom" id="prev_scene" aria-label="Quay lại" data-balloon-pos="up">
                    <i class="fa-solid fa-backward"></i>
                </li>
                <li class="icon_menu_bottom" id="show_thumbs" aria-label="Thumbs" data-balloon-pos="up">
                    <i class="fas fa-th-large"></i>
                </li>
            </div>
            <div class="sub_menu_center">
                <li class="icon_menu_bottom" id="icon_btn_left" aria-label="Left" data-balloon-pos="up">
                    <i class="fas fa-arrow-circle-left"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_btn_right" aria-label="Right" data-balloon-pos="up">
                    <i class="fas fa-arrow-circle-right"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_btn_up" aria-label="Up" data-balloon-pos="up">
                    <i class="fas fa-arrow-circle-up"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_btn_down" aria-label="Down" data-balloon-pos="up">
                    <i class="fas fa-arrow-circle-down"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_btn_zoomin" aria-label="Zoom in" data-balloon-pos="up">
                    <i class="fas fa-plus-circle"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_btn_zoomout" aria-label="zoom out" data-balloon-pos="up">
                    <i class="fas fa-minus-circle"></i>
                </li>
                <?php if($tour->setting_display->sound): ?>
                <li class="icon_menu_bottom" id="icon_mute" aria-label="Tắt âm thanh" data-balloon-pos="up">
                    <i class="fas fa-volume-off"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_unmute" aria-label="Mở âm thanh" data-balloon-pos="up">
                    <i class="fas fa-volume-mute"></i>
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
                <li class="icon_menu_bottom" id="" aria-label="Mở xoay" data-balloon-pos="up">
                    <i class="fas fa-share-alt"></i>
                </li>

            </div>
            <div class="sub_menu_right">
                <?php if($tour->setting_display->fullscreen): ?>
                <li class="icon_menu_bottom" id="icon_fullscreen" onclick="toggleFullscreen()" aria-label="Full màn hình" data-balloon-pos="up">
                    <i class="fa-solid fa-expand"></i>
                </li>
                <?php endif; ?>
                <li class="icon_menu_bottom" id="next_scene" aria-label="Đi tiếp" data-balloon-pos="up" >
                    <i class="fa-solid fa-forward"></i>
                </li>
            </div>
        </div>
    </div>

    <div class="menu_bottom_thumb" id="thumb">
        <div class="owl-carousel owl-theme list_thumb">
            <?php $__currentLoopData = $tour->panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item <?php if($key == 0): ?> active <?php endif; ?> <?php echo e($pano->id_thumb); ?>" id="<?php echo e($pano->id_thumb); ?>">
                <img src="<?php echo e($pano->thumb_img); ?>" class="img_thumb" alt="">
                <div class="content-thumb ">
                    <span class="title-thumb"><?php echo e($pano->name); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <iframe src="/tour/<?php echo e($tour->code); ?>/map" class="iframe_map" frameborder="0"
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

<script>

    var tour = <?php echo json_encode($tour); ?>

	var list_hotspot = <?php echo json_encode($list_hotspot_first); ?>

    var editor = <?php echo json_encode($isEditor); ?>

    var check_info = <?php echo json_encode($tour->infors); ?>

    var check_info_number = check_info.length;
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tour360.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Holo360\resources\views\template\template3.blade.php ENDPATH**/ ?>