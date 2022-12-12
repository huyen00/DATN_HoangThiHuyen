

$(document).ready(function() {
  // xử lý menu icon sub
  $("#icon_menusub").click(function() {
      $(".menu_sub").slideToggle();
  });
  // xu lý show menu
  $('.arrow-left').click(function(event) {
      $(".menu_tour").removeClass('show_menu_tour');
      $(".menu_tour").toggleClass('hide_menu_tour');
      $('.arrow-right').show();
      $('.arrow-left').hide();
  });
  $('.arrow-right').click(function(event) {
      $(".menu_tour").removeClass('hide_menu_tour');
      $(".menu_tour").toggleClass('show_menu_tour');
      $('.arrow-left').show();
      $('.arrow-right').hide();
  })
});

// xử lý share link
const button = document.querySelector('#icon_sharelink')
button.onclick = () => {
  navigator.clipboard.writeText(window.location.href);
}

// xư lý thumbs list
$(document).ready(function() {

  // xu lý click menu này ẩn menu kia
  // if( $(document).width() < 321 ){
  //     $("#icon_menusub").click(function(){
  //        $(".menu_sliderbar ").hide();
  //       });
  //       $("#arrow_right").click(function(){
  //          $(".menu_sub").hide();
  //          $(".menu_sliderbar ").show();
  //       });
  //    }
});