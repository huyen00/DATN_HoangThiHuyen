$(document).ready(function(){
  // xử lý popup
  $("#link_menu_top").click(function(){
    $(".list_sub_top_mobile").css("display","block");
   })

    // xử lý menu icon sub
    $(".icon_menu").click(function(){
      $(".menu_icon_slidebar").slideToggle();
    });

    // xu lý show menu
     $('.arrow-left').click(function(event){
      $(".menu_tour").removeClass('show_menu_tour');
      $(".menu_tour").toggleClass('hide_menu_tour');
      $('.arrow-right').show();
      $('.arrow-left').hide();
     });
     $('.arrow-right').click(function(event){
      $(".menu_tour").removeClass('hide_menu_tour');
      $(".menu_tour").toggleClass('show_menu_tour');
      $('.arrow-left').show();
      $('.arrow-right').hide();
     })
  });

  // show hide language
  $("#language_vn").click(function(){
    $("#language_vn").hide();
    $("#language_en").show();
  });
  $("#language_en").click(function(){
    $("#language_vn").show();
    $("#language_en").hide();
  });

   // show thumblist
   setTimeout(function() {
    $("#thumb").slideToggle();

  }, 5000);
    $("#show_thumbs").click(function(){
    $("#thumb").slideToggle();

  });
  $(document).ready(function(){
    $('.owl-carousel').owlCarousel({

        margin:10,
        nav:true,
        responsive:{
            0:{
                items:2
            },
      320:{
      items:2
      },
      480:{
      item:3
      },
            600:{
                items:5
            },
            992:{
              items:7
          },
            1024:{
                items:9
            },
            1400:{
              items:12
          }
        }
    });
    setTimeout(function() {
      $(".thumblist").slideToggle();
      $(".menu_sliderbar").addClass('hide_menu_tour');
  }, 5000);

  });

    // xử lý share link
    const button = document.querySelector('#icon_sharelink')
    button.onclick = () => {
    navigator.clipboard.writeText(window.location.href);
    }