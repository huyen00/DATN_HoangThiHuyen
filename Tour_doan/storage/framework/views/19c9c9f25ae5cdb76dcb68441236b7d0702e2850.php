
<?php $__env->startSection('content'); ?>
<div id="body">
    <div class="container">
        <div class="page_new">
            <div class="row">
                <div class="menu_page_left">
                    <h6 class="title_menu_page">Tin tức - Sự kiện</h6>
                    <h6 class="title_item_left"> Tin tức</h6>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                           Thông báo
                        </a>
                    </li>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                            Tin bài
                        </a>
                    </li>
                    <h6 class="title_item_left">Sự kiện</h6>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                            Sự kiện sắp diễn ra
                        </a>
                    </li>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                            Sự kiện đã diện ra
                        </a>
                    </li>
                    
                </div>
                <div class="content_page_right">
                    <div class="content_introduce">
                        <div class="image_banner_introduce">
                            <img src="../assets/image/banner1.jpg" class="img_page" alt="">
                        </div>
                        <div class="list_content_right">
                            <div class="row">
                                <div class="list_new_left">
                                    <div class="row">
                                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item_new_left">
                                            <div class="image_new">
                                                <img src="<?php echo e($new->image); ?>" class="img_page" alt="">
                                            </div>
                                            <a href="<?php echo e(route('new.detail',__($new->slug))); ?>">
                                                <h6 class="title_new"><?php echo e(__($new->title)); ?>

                                            </a>
                                            <div class="date_new">
                                                <span><?php echo e(\Carbon\Carbon::parse($new->created_at)->format('d/m/Y')); ?></span>
                                            </div>
                                            <div class="text_new">
                                                <span class="clamp three-lines text_page"><?php echo Str::words(strip_tags(__($new->content)), 10, '...'); ?></span>
                                            </div>
                                        </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      
                                    </div> 
                                </div>
                                <div class="list_new_right">
                                    <h6 class="title_noibat">Tin Nổi Bật</h6>
                                    <div class="content_new_right">
                                        <?php $__currentLoopData = $outstanding_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item_new_right">
                                            <div class="row">
                                                <div class="image_new_right">
                                                    <img src="<?php echo e($new->image); ?>" class="img_page" alt="">
                                                </div>
                                                <div class="text_new_right">
                                                    <span class="date_new_noibat">-> <?php echo e(\Carbon\Carbon::parse($new->created_at)->format('d/m/Y')); ?></span>
                                                    <a href="<?php echo e(route('new.detail',__($new->slug))); ?>" class=""><?php echo Str::words(strip_tags(__($new->content)), 10, '...'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              
                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landingpage.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/tintuc.blade.php ENDPATH**/ ?>