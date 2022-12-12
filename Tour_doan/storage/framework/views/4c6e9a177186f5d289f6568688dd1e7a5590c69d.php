<div class="page_news">
    <div class=" container content_news">
        <h2 class="title_page">Tin Mới Nhất</h2>
        <div class="list_news">
            <?php $__currentLoopData = $last_new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item_news">
                <div class="image_news">
                    <img src="landingpage/assets/image/tintuc1.jpeg" class="img-fluid" alt="">
                    <div class="blog">
                        <span>Tin tức</span>
                    </div>
                </div>

                <div class="content_item_news">
                    <a href="<?php echo e($new->image); ?>"><h5><?php echo e(__($new->title)); ?></h5></a>
                    <div class="text_content_item">
                        <span class="clamp three-lines text_page"><?php echo Str::words(strip_tags(__($new->content)), 10, '...'); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
       
    </div>
    <div class="see_more">
        <a href="page/tintuc.html" class="linh_see_more">Xem tin mới nhất</a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/theme/new.blade.php ENDPATH**/ ?>