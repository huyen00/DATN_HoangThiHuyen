
<?php $__env->startSection('title', $tour->name); ?>
<?php $__env->startSection('image',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->thumb : null)); ?>
<?php $__env->startSection('icon',asset( ($tour->setting_tour != null ) ? $tour->setting_tour->favicon : null)); ?>

<?php $__env->startSection('content'); ?>
<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>

<div class="option_menu_top">
    <div class="menu_top">
        <div class="logo_company">
          <img src="<?php echo e(($tour->setting_tour != null ) ? $tour->setting_tour->logo : null); ?>" class="img-fluid " alt="">
        </div>
		<li class="menu_mobile" id="menu_mobile">
			<a class="link_menu_mobile">
				<i class="fa-solid fa-bars"></i>
			</a>
		</li>
        <div class="menu_top_text">
            <ul class="list_menu_top">
				<?php $__currentLoopData = $tour->category_panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                	<li class="item_menu_top">
						<a class="link_menu_top"> <?php echo e($category->name); ?> <i class="fa-solid fa-caret-down"></i></a>
						<ul class="list_sub_top">
						<?php $__currentLoopData = $category->panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="item_sub_top" id="<?php echo e($pano->id_thumb); ?>">
							<a class="link_sub"><?php echo e($pano->name); ?></a>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
                	</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>

        </div>
        <div class="menu_top_mobile">
          <ul class="list_menu_top_mobile">

            <?php $__currentLoopData = $tour->category_panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="item_menu_top_mobile" id="check_<?php echo e($category->id); ?>">

                        <a  class="link_menu_top_mobile"> <?php echo e($category->name); ?> 		 </a>
                        <ul class="list_sub_top_mobile" id="panel_<?php echo e($category->id); ?>">
                          <?php $__currentLoopData = $category->panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="item_menu_top_mobile link_mobile" id="<?php echo e($pano->id_thumb); ?>">
                                <a class="link_menusub_top_mobile"><?php echo e($pano->name); ?></a>
                            </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
        </div>
    </div>
</div>
<div class="background_sound"></div>
	<!-- <div class="logo_tour">
		<img src="assets/img/logo_trahoavang1.png" class="img-fluid " alt="">
		<li class="logo_ocop">
			Doanh nghiệp OCOP 4 *
		</li>
	</div> -->

	<!-- menu icon top- right -->
	<ul class="hide_show_menusub">

		<ul class="menu_sub" id="menu_sub">
      <?php if($tour->setting_display->sound): ?>
	  <div class=" item_icon list_sound" id="list_sound" >
		<li class=" " id="icon_mute">
			<i class="fas fa-volume-off"></i>

		</li>
	
		<div class="change_sound" id="change_sound">
		<!-- <?php $__currentLoopData = $tour->sounds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sounds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> -->
			<li class="item_sound" id="sound1">
				<span>Nhạc nền 1</span>
			</li>
			<!-- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
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
      <?php if($tour->setting_display->infor): ?>
			<li class="item_icon" id="icon_info" onclick="show_info()" aria-label="<?php echo e(__('infor')); ?>" data-balloon-pos="up">
				<i class="fas fa-info-circle"></i>

			</li>
      <?php endif; ?>
      <?php if($tour->setting_display->setting_map): ?>
			<li class="item_icon" id="icon_map"  aria-label="<?php echo e(__('map')); ?>" data-balloon-pos="up" onclick="show_map()">
				<i class="fas fa-map"></i>

			</li>
      <?php endif; ?>
			<li class="item_icon" id="icon_album" aria-label="Album" data-balloon-pos="up" onclick="show_album()">
				<i class="fa-solid fa-images"></i>

			</li>
			<?php if($tour->setting_display->show_hotspot): ?>
			<li class="item_icon" id="hotspot_Close" aria-label="<?php echo e(__('hide_hotspot')); ?>" data-balloon-pos="up">
				<i class="fas fa-toggle-off"></i>

			</li>
			<li class="item_icon" id="hotspot_open" aria-label="<?php echo e(__('show_hotspot')); ?>" data-balloon-pos="up">
				<i class="fas fa-toggle-on"></i>

			</li>
      <?php endif; ?>

      <?php if($tour->setting_display->rotate): ?>
			<li class="item_icon" id="icon_rotate" aria-label="<?php echo e(__('off_rotate')); ?>" data-balloon-pos="up">
				<i class="fa-solid fa-rotate-right"></i>

			</li>
			<li class="item_icon" id="icon_unrotate" aria-label="<?php echo e(__('open_rotate')); ?>" data-balloon-pos="up">
				<i class="fa-solid fa-clock-rotate-left"></i>

			</li>
      <?php endif; ?>
      <?php if($tour->setting_display->setting_vr): ?>
			<li class="item_icon" id="icon_VR" aria-label="VR" data-balloon-pos="up">
				<i class="fas fa-vr-cardboard"></i>

			</li>
      <?php endif; ?>
      <?php if($tour->setting_display->fullscreen): ?>
			<li class="item_icon" id="icon_fullscreen" onclick="toggleFullscreen()" aria-label="<?php echo e(__('fullscreen')); ?>" data-balloon-pos="up">
				<i class="fas fa-expand"></i>
			</li>
      <?php endif; ?>
		</ul>
		<li class="item_icon" id="icon_menusub">
			<i class="fas fa-ellipsis-v"></i>
		</li>
	</ul>
	<ul class="menu_contact">
		<ul class="menu_contact_mobile">
      <?php if($tour->setting_display->contact): ?>
			<li class="item_icon" id="icon_form" aria-label="<?php echo e(__('contact')); ?>" data-balloon-pos="right" onclick="show_contact()">
				<i class="fas fa-address-book"></i>
			</li>
      <?php endif; ?>
      <?php if($tour->setting_display->guide): ?>
			<li class="item_icon" id="icon_guide" aria-label="<?php echo e(__('guide')); ?>" data-balloon-pos="right" onclick="show_guide()">
				<i class="fas fa-question"></i>
			</li>
      <?php endif; ?>
	  <?php if($tour->setting_display->share): ?>
				<li class="item_icon" id="icon_sharelink" aria-label="Sao chép link" data-balloon-pos="right">
					<i class="fas fa-share-alt"></i>
				</li>
      	<?php endif; ?>
		<?php if($tour->setting_display->back_scene): ?>
		<li class="item_icon" id="icon_backscene">
				<i class="fa-solid fa-reply"></i>
		</li>
		<?php endif; ?>
		
		</ul>
		<ul class="name_scene">
			<h2 class="title_name_scene" id="name_scene"><?php echo e($tour->panos[0]->name); ?></h3>
			<span class="title_tour"><?php echo e($tour->name); ?></span>
		</ul>

	</ul>
	<!-- album thumb -->
	<div class="album_thumb" id="album_thumb">
		<div class="list_album_thumb">
			<div class="close_album_thumb" onclick="close_album()">
				<i class="fas fa-times"></i>
			</div>
			<div class="row list_album">
				<?php $__currentLoopData = $tour->panos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="item_album" id="<?php echo e($pano->id_thumb); ?>">
					<div class="item_img_album">
						<img src="<?php echo e($pano->thumb_img); ?>" class="img-fluid img_album" alt="">
					</div>
					<div class="title_album">
						<span><?php echo e($pano->name); ?></span>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>

 <!-- form info tong quat -->

 <div class="general_info" id="general_info">
	<span class="button_close" id="close_general" onclick="close_form()">
		<i class="fas fa-times"></i>
	</span>
	<div class="form_general_info">
		<h5>Giới Thiệu Chung </h5>
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
            <?php if(count($info->images) > 0): ?>
			<div class="footer_icon" onclick="show_image(<?php echo e($info->id); ?>)" id="footer_image">
				Hình ảnh
				<i class="fa-solid fa-image icon_image"></i>
			</div>
            <?php endif; ?>
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
					<img src="/<?php echo e($image->image); ?>" class="img-fluid img_album" alt="">
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
		<iframe src="tour/<?php echo e($tour->code); ?>/map" class="iframe_map" frameborder="0"
		allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
		allowfullscreen frameborder="0"></iframe>
	</div>
</div>
<!-- contact -->
<div class="contact" id="contact">
	<div class="form_contact">
		<h3 class="title_contact"><?php echo e(__('contact')); ?></h3>
		<form id="contact-form" >
			<input type="hidden" name="_token" value="2d7EP09QskNLTOighldVx0TZxQ3ae1iotrMIeMfq">
			<div class="form-group ">
				<input type="text" name="name" id="name" class="form-control" placeholder="<?php echo e(__('name')); ?>">
			</div>
			<div class="form-group ">
				<input type="text" name="email" id="phone" class="form-control" placeholder="<?php echo e(__('email')); ?>">
			</div>
			<div class="form-group ">
				<input type="text" name="phone" id="phone" class="form-control" placeholder="<?php echo e(__('phone')); ?>">
			</div>
			<div class="form-group ">
				<textarea class="form-control" name="message" id="message" placeholder="<?php echo e(__('message')); ?>" rows="3" cols="4"></textarea>
			</div>
			<div style="text-align:center">
				<button type="submit" class=" btn-sub text-uppercase"><?php echo e(__('send_us')); ?></button>
			</div>
		</form>
	</div>
	<span class="button_close" id="close_general" onclick="close_form()">
		<i class="fas fa-times"></i>
	</span>
</div>

<div class="info_hotspot" id="info_hotspot">
<span class="button_close" id="close_info_hotspot" onclick="close_info_hotspot()">
	<i class="fas fa-times"></i>
</span>
<div class="form_info">
	<div class="title_info">
		<h5 id="title_info_hotspot" ></h5>
	</div>
	<hr class="line">
	<div class="content_info">
		<div class="text_content_info" id="text_content_info_hotspot">

		</div>
	</div>
	<div class="footer_info">
		
	</div>
</div>
</div>

<!-- image hotspot -->


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

    var check_info = <?php echo json_encode($tour->infors); ?>

    var check_info_number = check_info.length;
	console.log(tour.panos);
    console.log(check_info[0].id)
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('tour360.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Tour_doan\resources\views/template/template2.blade.php ENDPATH**/ ?>