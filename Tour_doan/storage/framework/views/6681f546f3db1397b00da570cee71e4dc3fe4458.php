<div class="page_Admissions">
    <div class="container">
        <div class="content_admissions">
            <div class="title_admissions">
                <h2 class="title_page"><?php echo e(__($section->title)); ?></h2>
                <div class="text_admissions">
                    <span class="text_page"><?php echo e(__($section->sub_title)); ?></span>
                </div>
            </div>
            <div class="row ">
                <?php $__currentLoopData = $section->page_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
          
                <div class="col_edu_admissions">
                    <div class="row content_col_edu ">
                        <div class="image_education">
                        
                            <img  src="<?php echo e(count($content->images) >0 ? $content->images[0]->image : ''); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="content_education">
                            <h6 class="title_education"><?php echo e(__($content->title)); ?></h6>
                            <div class="text_education">
                                <span class="text_page">
                                    <?php echo Str::words(strip_tags(__($content->description)), 15, '...'); ?>

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
<?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/theme/page_Admissions.blade.php ENDPATH**/ ?>