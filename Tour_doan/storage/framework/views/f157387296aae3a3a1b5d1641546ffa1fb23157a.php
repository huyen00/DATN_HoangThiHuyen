<!doctype html>
<html lang="en">
  <head>
    <title>Đồ án Tốt Nghiệp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <base href="<?php echo e(asset('')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="landingpage/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="landingpage/assets/css/owl.theme.default.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="stylesheet" href="landingpage/assets/css/header_footer.css">
    <link rel="stylesheet" href="landingpage/assets/css/home.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
   
    <?php echo $__env->make('landingpage.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
 


   
   

      

      
        <?php echo $__env->make('landingpage.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    
    <script src="landingpage/assets/js/jquery.pan.js"></script>
    <script src="landingpage/assets/js/owl.carousel.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="landingpage/assets/js/main.js"></script>

    <script>
       $(document).ready(function(){
      $('.owl-carousel').owlCarousel({
          // loop:true,
          margin:10,
        //   nav:false,
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
                  items:4
              }
          }
      });
  });
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Project_2022\Tour_doan\resources\views/landingpage/layout.blade.php ENDPATH**/ ?>