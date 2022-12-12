<div class="page_event">
    <div class="content_event">
        <div class="image_event">
            <img src="landingpage/assets/image/banner2.jpg" class="img-fluid img_item_event" alt="">
            <div class="content_image_event">
                <h2 class="title_page text-white"><?php echo e(__($section->title)); ?></h2>
                <div class="list_event">
                    <div class="container d-flex">
                        <?php $__currentLoopData = $section->page_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item_event">
                            <img src="<?php echo e(count($content->images) >0 ? $content->images[0]->image : ''); ?>" class="img-fluid item_image_event" alt="">
                            <div class="content_item_event">
                                <h5><?php echo e(__($content->title)); ?></h5>
                                <div class="text_content_item">
                                    <span class="clamp three-lines text_page"><?php echo Str::words(strip_tags(__($content->description)), 10, '...'); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="see_more mt-0">
            <a href="" class="linh_see_more">Xem sự kiện mới nhất</a>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/theme/page_event.blade.php ENDPATH**/ ?>