
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
    <div class="show_menu">
        <li class="item_icon icon_show_menu arrow-right " id="arrow_right">
            <i class="fas fa-caret-right "></i>
        </li>
        <li class="item_icon icon_show_menu arrow-left">
            <i class="fas fa-caret-left"></i>
        </li>
    </div>
    <div class="menu_sliderbar">
        <div class="list_sliderbar">
            <div class="slider_logo">
                <img src="<?php echo e(($tour->setting_tour != null ) ? $tour->setting_tour->logo : null); ?>" class="img-fluid"
                    alt="">
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
                                <p class="link_menu"><?php echo e($item->name); ?></p>
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
        <li class="icon_menu_bottom" id="show_menu_bottom" aria-label="Hi???n menu" data-balloon-pos="up">
            <i class="fa-solid fa-circle-chevron-up"></i>
        </li>
    </div>
    <div class="background_sound"></div>
    <div class="menu_bottom">
        <div class="list_menu_bottom">
            <div class="sub_menu_left">
                <li class="icon_menu_bottom" id="prev_scene" aria-label="Quay l???i" data-balloon-pos="up">
                    <i class="fa-solid fa-backward"></i>
                </li>
                <li class="icon_menu_bottom" id="close_menu_bottom" aria-label="???n menu" data-balloon-pos="up">
                    <i class="fa-solid fa-xmark"></i>
                </li>
            </div>
            <div class="sub_menu_center">
                <?php if($tour->setting_display->infor): ?>
                <li class="icon_menu_bottom" id="icon_info" aria-label="Th??ng tin" data-balloon-pos="up" onclick="show_info()">
                    <i class="fa-solid fa-circle-info"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->setting_map): ?>
                <li class="icon_menu_bottom" id="icon_map" aria-label="Map" data-balloon-pos="up" onclick="show_map()">
                    <i class="fas fa-map"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->sound): ?>
                <div class="icon_menu_bottom">
                    <li class="" id="icon_mute" >
                        <i class="fas fa-volume-off"></i>

                    </li>
                    <div class="change_sound" id="change_sound">
                        <li class="item_sound" id="sound1">
                            <span>Nh???c n???n 1</span>
                        </li>
                        <li class="item_sound" id="sound2">
                            <span>Nh???c n???n 2</span>
                        </li>
                        <li class="item_sound" id="text_unmute">
                            <span>T???t ??m thanh</span>
                        </li>
                        <li class="item_sound" id="text_mute">
                            <span>B???t ??m thanh</span>
                        </li>
                    </div>

                    <li class="" id="icon_unmute" >
                        <i class="fas fa-volume-mute"></i>

                    </li>
                </div>

                <?php endif; ?>
                <?php if($tour->setting_display->show_hotspot): ?>
                <li class="icon_menu_bottom" id="hotspot_Close" aria-label="???n hotspot" data-balloon-pos="up">
                    <i class="fas fa-toggle-off"></i>
                </li>

                <li class="icon_menu_bottom" id="hotspot_open" aria-label="Hi???n hotspot" data-balloon-pos="up">
                    <i class="fas fa-toggle-on"></i>
                </li>
                <?php endif; ?>
                <?php if($tour->setting_display->rotate): ?>
                <li class="icon_menu_bottom" id="icon_rotate" aria-label="T???t xoay" data-balloon-pos="up">
                    <i class="fa-solid fa-rotate-right"></i>
                </li>
                <li class="icon_menu_bottom" id="icon_unrotate" aria-label="M??? xoay" data-balloon-pos="up">
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
                    aria-label="Full m??n h??nh" data-balloon-pos="up">
                    <i class="fa-solid fa-expand"></i>
                </li>
                <?php endif; ?>
                <li class="icon_menu_bottom" id="next_scene" aria-label="??i ti???p" data-balloon-pos="up">
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
        <ul class="menu_sub menu_sub_template1">
            <?php if($tour->setting_display->contact): ?>
            <li class="item_icon" id="icon_contact" aria-label="Li??n h???" data-balloon-pos="left" onclick="show_contact()">
                <i class="fas fa-address-book"></i>
            </li>
            <?php endif; ?>
            <?php if($tour->setting_display->guide): ?>
            <li class="item_icon" id="icon_guide" aria-label="H?????ng d???n" data-balloon-pos="left" onclick="show_guide()">
                <i class="fas fa-question"></i>
            </li>
            <?php endif; ?>
            <?php if($tour->setting_display->share): ?>
            <li class="item_icon" id="icon_sharelink" aria-label="Sao ch??p link" data-balloon-pos="left">
                <i class="fas fa-share-alt"></i>
            </li>
            <?php endif; ?>
            <li class="item_icon" id="icon_mute1" aria-label="T???t ??m thanh" data-balloon-pos="left">
                <i class="fas fa-volume-off"></i>
            </li>
            <li class="item_icon" id="icon_unmute1" aria-label="M??? ??m thanh" data-balloon-pos="left">
                <i class="fas fa-volume-mute"></i>
            </li>
            <li class="item_icon" id="icon_rotate1" aria-label="T???t xoay" data-balloon-pos="left">
                <i class="fa-solid fa-rotate-right"></i>
            </li>
            <li class="item_icon" id="icon_unrotate1" aria-label="M??? xoay" data-balloon-pos="left">
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
        <h5>Gi???i Thi???u Chung V???</h5>
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
                H??nh ???nh
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
        <h3 class="title_contact">Li??n H??? </h3>
        <form id="contact-form" >
            <input type="hidden" name="_token" value="2d7EP09QskNLTOighldVx0TZxQ3ae1iotrMIeMfq">
            <div class="form-group ">
                <input type="text" name="name" id="name" class="form-control" placeholder="T??n ">
            </div>
            <div class="form-group ">
                <input type="text" name="email" id="phone" class="form-control" placeholder="?????a ch??? email">
            </div>
            <div class="form-group ">
                <input type="text" name="phone" id="phone" class="form-control" placeholder="S??? ??i???n tho???i">
            </div>
            <div class="form-group ">
                <textarea class="form-control" name="message" id="message" placeholder="Tin nh???n..." rows="3" cols="4"></textarea>
            </div>
            <div style="text-align:center">
                <button type="submit" class=" btn-sub text-uppercase">G???i cho ch??ng t??i</button>
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
            H??nh ???nh
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
                <span>To??n c???nh 01</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/15_nguyenlieua1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu nguy??n li???u A1</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/2_nguyenlieua2.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu nguy??n li???u A2</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/3_nguyenlieua4.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu nguy??n li???u A3</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/13_khunguyenlieub1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu nguy??n li???u B1</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/4_nguyenlieub6.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu nguy??n li???u B2</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/5_khusxcayduoclieu.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu nh?? tr??ng b??y</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/6_traloai1.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>Khu tr??ng b??y d?????c li???u</span>
            </div>
        </div>
        <div class="item_image">
            <img src="panos/7_traloai2.tiles/thumb.jpg" class="img-fluid img_album" alt="">
            <div class="title_image">
                <span>khu tr??ng b??y tr?? Lo???i 2</span>
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
			<h5>H?????ng d???n</h5>
		</div>
		<table>
			<tbody>
				<tr>
					<td>
						<img src="" class="img_guide"  class="img-fluid" alt="">
					</td>
					<td>
						<div class="form_guide_text">1. Click gi??? v??o ???nh r???i k??o v??? ph??a c???n xem.<br>
								   2. ????a con tr??? chu???t v??o c??c ??i???m ???????c ????nh d???u ????? xem tr?????c th??ng tin c??c ?????a ??i???m kh??c,        click v??o ????? chuy???n ?????n ?????a ??i???m t????ng ???ng<br>
								3. S??? d???ng thanh menu ph??a d?????i ????? khai th??c c??c t??nh n??ng kh??c.</div>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var tour = <?php echo json_encode($tour); ?>

	var list_hotspot = <?php echo json_encode($list_hotspot_first); ?>

	var editor = <?php echo json_encode($isEditor); ?>

    var check_info = <?php echo json_encode($tour->infors); ?>

    var check_info_number = check_info.length;
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
                   items:1
                 },
                 480:{
                   item:2
                 },
                 600:{
                     items:3
                 },
                 1000:{
                     items:7
                 }
             }
         });
     });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tour360.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Holo360\resources\views/template/template1.blade.php ENDPATH**/ ?>