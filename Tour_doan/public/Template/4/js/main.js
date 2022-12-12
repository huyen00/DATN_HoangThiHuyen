// xu ly menu  setting right
$(".icon_setting").click(function(){
  $(".list_setting").slideToggle();
  $(".background_sound").show();
});
$(".background_sound").click(function(){
  $(".list_setting").hide();
  $(".background_sound").hide();
});

$(".icon_menu").click(function(){
  $(".menu_right").slideToggle();
});
$(document).ready(function(){
  $('.owl-carousel').owlCarousel({

      margin:10,
      nav:true,
      responsive:{
          0:{
              items:1
          },
    320:{
    items:2
    },
    480:{
    item:3
    },
          600:{
              items:4
          },
          992:{
            items:6
        },
          1024:{
              items:6
          },
            1024:{
                items:6
            },
            1400:{
              items:7
          }
        }
    });

    // show thumblist
    setTimeout(function() {
      $("#thumb").slideToggle();
    }, 5000);
      $("#show_thumbs").click(function(){
      $("#thumb").slideToggle();
    });
  });