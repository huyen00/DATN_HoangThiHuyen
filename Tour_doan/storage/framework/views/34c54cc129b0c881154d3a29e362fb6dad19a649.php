<div class="page_alumni">
    <div class="container">
        <div class="content_alumni">
            <h2 class="title_page"><?php echo e(__($section->title)); ?></h2>
            <div class="list_alumni">
                <div class="multiple-items">
                    <?php $__currentLoopData = $section->page_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item_alumni">
                        <div class="content_item_alumni">
                            <img src="<?php echo e(count($content->images) >0 ? $content->images[0]->image : ''); ?>" class="img-fluid" alt="">
                            <div class="blog_alumni">
                                <span><?php echo e(__($section->title)); ?></span>
                            </div>
                        </div>
                        <div class="content_text_alumni">
                            <a href="" class="link_alumni">
                                <h6><?php echo e(__($content->title)); ?></h6>
                                <span class="clamp three-lines text_page">  <?php echo Str::words(strip_tags(__($content->description)), 60, '...'); ?> </span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/theme/page_alumni.blade.php ENDPATH**/ ?>