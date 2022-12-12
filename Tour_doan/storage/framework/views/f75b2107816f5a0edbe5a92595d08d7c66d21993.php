<div class="page_cooperate">
    <div class="content_cooperate">
        <img src="landingpage/assets/image/banner1.jpg" class="img-fluid img_cooperate" alt="">
        <div class="content_image_cooperate">
            <div class="container">
                <h2 class="title_page text-white"><?php echo e(__($section->title)); ?></h2>
                <div class="text_cooperate text-center">
                    <span class="text_page text-white "><?php echo e(__($section->sub_title)); ?></span>
                </div>
                <div class="list_cooperate">
                    <?php $__currentLoopData = $section->page_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item_cooperate">
                        <div class="row">
                            <div class="image_cooperate">
                                <img src="<?php echo e(count($content->images) >0 ? $content->images[0]->image : ''); ?>" class="img-fluid img_item_cooperate" alt="">
                            </div>
                            <div class="content_cooperate_item">
                                <h6 class="title_cooperate"><?php echo e(__($content->title)); ?></h6>
                                <div class="text_cooperate">
                                    <span class="text_page">
                                        <?php echo Str::words(strip_tags(__($content->description)), 70, '...'); ?>

                                        <a href="">(xem tiếp)</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                
                </div>
            </div>
            
        </div> 
    </div>
           
</div><?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/theme/page_cooperate.blade.php ENDPATH**/ ?>