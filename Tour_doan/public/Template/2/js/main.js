// show album thumb

// close album
// $("#icon_mute").click(function(){
//   $("#change_sound").slideToggle();
// })

// click form
$(document).ready(function() {
    if( $(document).width() < 321){
      $("#list_sound").click(function(){
         $("#change_sound1").show();
        });
     }
      // icon mobile
      $("#icon_menusub").click(function() {
              $(".menu_sub").slideToggle();
          })
          //  menu mobile top
      $("#menu_mobile").click(function() {
          $(".menu_top_mobile").slideToggle();
      });
      $(".item_menu_top_mobile").click(function(event){
            var id = $(this).attr("id").split('_')[1];
            $(".list_sub_top_mobile").hide();
            $(`#panel_${id}`).show();
        });
      // xư lý click menu top ẩn menu icon
      if( $(document).width() < 801){
          $("#menu_mobile").click(function(){
             $("#menu_sub").hide();
            });
            $("#icon_menusub").click(function(){
               $(".menu_top_mobile").hide();
            });
      }
  });
  
  
  
  