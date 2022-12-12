<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <base href="<?php echo e(asset('')); ?>">
    <link rel="icon" href="<?php echo $__env->yieldContent('icon'); ?>" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta property="og:image" content="<?php echo $__env->yieldContent('image'); ?>" />
    <meta name="copyright" content="Holomia">
    <meta name="generator" content="holomia.com">
    <meta name="author" content="holomia.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">
    <?php if($tour->template ==null): ?>
	<link rel="stylesheet" href="assets/css/style.css">
    <?php else: ?>
    <link rel="stylesheet" href="<?php echo e($tour->template->link_css); ?>">
    <?php endif; ?>


    <?php if($tour->template ==null): ?>
     <link rel="stylesheet" href="assets/css/responsive.css">
    <?php elseif($tour->template->responsive): ?>
        <link  rel="stylesheet" href="<?php echo e($tour->template->responsive); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="assets/css/responsive.css">
    <?php endif; ?>

	<link rel="stylesheet" href="assets/css/jquery.pan.css" type="text/css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/map.css">

	<style>
		html { height:100%; }
		body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; background-color:#000000; }
	</style>
    <body>
        <script src="/assets/js/tour.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        
        <?php echo $__env->yieldContent('content'); ?>
        <?php if($isEditor == true): ?>
            <div id="btn_Savexml" style=" position: absolute;
            top: 300px;
            right: 20px;
            z-index: 100;
            background: black;"> Save XMl</div>
        <?php endif; ?>
        <div class="panWrapper" id="minimap" style="display: none;">
			<a class="controls in"></a>
			<a class="controls out"></a>
			<img class="i image_pan mx-auto d-block center-block"
				style="position: absolute; width: auto; left: -13px; top: 114.5px;"
				src="assets/img/Map_DinhVi.jpg">
		</div>

        
        <script src="assets/js/jquery.pan.js"></script>
        


        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="assets/js/connectxml.js"></script>


        
        <script src="assets/js/main.js"></script>
        

        <?php if($tour->template ==null): ?>

        <?php elseif($tour->template->link_js): ?>

            <script src="<?php echo e($tour->template->link_js); ?>"></script>
        <?php else: ?>

        <?php endif; ?>

        <script>
            // var slideIndex = 1;
            // showDivs(slideIndex);

            // function plusDivs(n) {
            //     showDivs(slideIndex += n);
            // }

            // function showDivs(n) {
            //     var i;
            //     var x = document.getElementsByClassName("mySlides");
            //     if (n > x.length) {
            //         slideIndex = 1
            //     }
            //     if (n < 1) {
            //         slideIndex = x.length
            //     }
            //     for (i = 0; i < x.length; i++) {
            //         x[i].style.display = "none";
            //     }
            //     x[slideIndex - 1].style.display = "block";
            // }
        </script>
        <script type="text/javascript">

            $(document).ready(function() {
                $(".pan").pan();
            })
        </script>

    </body>

    <style>
        <?php if($tour->setting_color != null): ?>
        
        .title_icon_menu{
            color: <?php echo e($tour->setting_color->icon_color ?? null); ?>  !important ;
        }
        .item_icon {
            background-color: <?php echo e($tour->setting_color->bg_icon_color?? null); ?>;
            color: <?php echo e($tour->setting_color->icon_color?? null); ?>;
        }
        .item_icon:hover {
            background-color: <?php echo e($tour->setting_color->hover_bg_icon_color?? null); ?>;
            color: <?php echo e($tour->setting_color->hover_color_icon?? null); ?>;
        }
        .item_icon .active {
            background-color: <?php echo e($tour->setting_color->hover_bg_icon_color?? null); ?>;
            color: <?php echo e($tour->setting_color->hover_color_icon?? null); ?>;
        }

        .item_menu_bottom  {
            background-color: <?php echo e($tour->setting_color->bg_icon_color ?? null); ?>;

        }
        .item_menu_bottom:hover {
            background-color: <?php echo e($tour->setting_color->hover_bg_icon_color ?? null); ?>;
        }
        .item_menu_bottom .active {
            background-color: <?php echo e($tour->setting_color->active_bg_icon_color ?? null); ?>;
        }
        .item_menu_right{
            background-color: <?php echo e($tour->setting_color->bg_icon_color?? null); ?>;
        }
        .item_menu_right ,i{
            color: <?php echo e($tour->setting_color->icon_color?? null); ?>;
        }
        .item_menu_right:hover{
            background-color: <?php echo e($tour->setting_color->hover_bg_icon_color?? null); ?>;
            color: <?php echo e($tour->setting_color->hover_color_icon?? null); ?>;
        }
        .list_setting{
            background-color: <?php echo e($tour->setting_color->bg_icon_color ?? null); ?> !important;
        }
        .title_setting{
            background-color: <?php echo e($tour->setting_color->bg_icon_color ?? null); ?>  !important ;
            color: <?php echo e($tour->setting_color->icon_color ?? null); ?>  !important ;
        }
        .item_setting:hover{
            background-color: <?php echo e($tour->setting_color->hover_bg_icon_color ?? null); ?>  !important ;

        }
        .item_setting.active{
            background-color: <?php echo e($tour->setting_color->active_bg_icon_color ?? null); ?>  !important ;

        }

        .change_sound{
            background-color: <?php echo e($tour->setting_color->bg_icon_color?? null); ?>;
        }
        .item_sound:hover{
            background-color: <?php echo e($tour->setting_color->hover_bg_icon_color ?? null); ?>  !important ;

        }
        .item_sound.active{
            background-color: <?php echo e($tour->setting_color->active_bg_icon_color ?? null); ?>  !important ;

        }



        

        
        .list_sub_top{
            background-color: <?php echo e($tour->setting_color->bg_menu_color??null); ?>

        }
        .option_menu_top{
            background-color: <?php echo e($tour->setting_color->bg_menu_color??null); ?>

        }

        .item_sub_top:hover{
            background-color: <?php echo e($tour->setting_color->hover_color_item ??null); ?>

        }
        .item_sub_top:active{
            background-color: <?php echo e($tour->setting_color->active_color_item ??null); ?>

        }


        


        .list-thumbs{
            background-color: <?php echo e($tour->setting_color->bg_menu_color?? null); ?>;
        }
        .menu_sliderbar{
            background-color: <?php echo e($tour->setting_color->bg_menu_color?? null); ?>;
        }
        .title_menu {
            background-color: <?php echo e($tour->setting_color->bg_color_category?? null); ?>;
            color: <?php echo e($tour->setting_color->color_category?? null); ?>;
        }
        .link_menu  {

            color: <?php echo e($tour->setting_color->color_item?? null); ?>;
        }
        .link_menu:hover{

            color: <?php echo e($tour->setting_color->hover_color_item?? null); ?>;
        }
        .link_menu .active{

            color: <?php echo e($tour->setting_color->active_color_item ?? null); ?>;
        }

        <?php endif; ?>

        <?php if($tour->font != null): ?>
            @font-face {
            font-family: myFirstFont;
            src: url(<?php echo e($tour->font->font); ?>);
            }

            body, div, button, a, p {
                font-family: myFirstFont !important;
                font-size: <?php echo e($tour->font->size); ?>px !important;
                font-weight: <?php echo e($tour->font->weight); ?>  !important;;
            }

            iframe h1,a,p{
                font-family: myFirstFont !important;
            }
        <?php endif; ?>

    </style>
</head>
<?php /**PATH C:\xampp\htdocs\Tour_doan\resources\views/tour360/layout/index.blade.php ENDPATH**/ ?>