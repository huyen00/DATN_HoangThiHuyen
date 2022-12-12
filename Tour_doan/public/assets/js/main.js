// form
//  show info
function closeDefault(){
  document.getElementById('general_info').style.display = "none";
  document.getElementById('map').style.display = "none";
  document.getElementById('contact').style.display = "none";
  document.getElementById('guide').style.display = "none";
  document.getElementById('album_thumb').style.display = "none";
}
function show_info() {
  if ($(document).width() < 321) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 601) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 1025) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };

  document.getElementById('map').style.display = "none";
  document.getElementById('contact').style.display = "none";
  document.getElementById('guide').style.display = "none";
  document.getElementById('album_thumb')? document.getElementById('album_thumb').style.display = "none":null;
  document.getElementById('general_info').style.display = "flex";
}
// show item info
function show_item_info(id){
  $(`#info_${id}`).css('display','flex');
  $("#general_info").css('display','none');
  resetAudio();
}

// show image
function show_image(id) {
  closeDefault();
  $(`#image_${id}`).css('display', 'flex');
  $(`#info_${id}`).css('display', 'none');
  resetAudio();
}
// close info
function close_form() {
  if ($(document).width() < 321) {
      // $(".menu_sub").show();
      $(".menu_icon_slidebar").show();
  };
  if ($(document).width() < 601) {
      // $(".menu_sub").show();
      $(".menu_icon_slidebar").show();
  };
  if ($(document).width() < 1025) {
      // $(".menu_sub").show();
      $(".menu_icon_slidebar").show();
  };

  closeDefault();
}

// close imtem info
function close_item_info(id) {
  if(check_info_number >1 ){
  $("#general_info").css('display', 'flex');
  }
  $(`#info_${id}`).css('display', 'none');
  resetAudio();
}
// close image info
function close_image(id) {
  $(`#info_${id}`).css('display', 'flex');
  $(`#image_${id}`).css('display', 'none');

}
// xử lý popup info hotspot

function showform(title,data) {

  if ($(document).width() < 601) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 801) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 1025) {
      $(".menu_icon_slidebar").hide();

  };
  document.getElementById('info_hotspot').style.display = "flex";
  $("#title_info_hotspot").html(title);
  $("#text_content_info_hotspot").html(data);
  console.log(data);
}
// close info hotspot
function close_info_hotspot() {
  if ($(document).width() < 321) {
      $(".menu_icon_slidebar").show();
  };
  if ($(document).width() < 601) {
      $(".menu_icon_slidebar").show();
  };
  if ($(document).width() < 1025) {
      $(".menu_icon_slidebar").show();
  };
  $(`#info_hotspot`).css('display', 'none');
  resetAudio();
}
// show image hotspot
function show_image_hotspot() {
  if ($(document).width() < 321) {
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 601) {
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 1025) {

      $(".menu_icon_slidebar").hide();
  };
  $(`#info_hotspot`).css('display', 'none');
  $('#image_hotspot').css('display', 'flex');
  resetAudio();
}
// close image hotspot
function close_image_hotspot() {

  $('#image_hotspot').css('display', 'none');
  $(`#info_hotspot`).css('display', 'flex');

  resetAudio();
}
// show album thumb
function show_album(){
if( $(document).width() < 321 ){
    $(".menu_sub").hide();
  };
  if( $(document).width() < 801 ){
    $(".menu_sub").hide();
  };
  document.getElementById('contact').style.display = "none";
  document.getElementById('guide').style.display = "none";
  document.getElementById('map').style.display = "none";
  document.getElementById('general_info').style.display = "none";
document.getElementById('album_thumb').style.display = "block";
}
// show map
function show_map() {
  if ($(document).width() < 321) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 601) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 1025) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };

  document.getElementById('contact').style.display = "none";
  document.getElementById('guide').style.display = "none";
  document.getElementById('album_thumb')? document.getElementById('album_thumb').style.display = "none": null;
  document.getElementById('map').style.display = "flex";
}
// show contact
function show_contact() {
  if ($(document).width() < 321) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 601) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  if ($(document).width() < 1025) {
      $(".menu_sub").hide();
      $(".menu_icon_slidebar").hide();
  };
  document.getElementById('contact').style.display = "flex";
  document.getElementById('map').style.display = "none";
  document.getElementById('guide').style.display = "none";
  document.getElementById('album_thumb')? documentgetElementById('album_thumb').style.display = "none":null;

}
function close_album(){
  if( $(document).width() < 321 ){
      $(".menu_sub").show();
  };
  if ($(document).width() < 801) {
      $(".menu_sub").show();
  };
  document.getElementById('album_thumb').style.display = "none";
}
// show guide
function show_guide(){
if( $(document).width() < 321 ){
    $(".menu_sub").hide();
  };
  if ($(document).width() < 801) {
      $(".menu_sub").hide();
  };
  document.getElementById('map').style.display = "none";
  document.getElementById('contact').style.display = "none";
  document.getElementById('album_thumb')? document.getElementById('album_thumb').style.display = "none":null;
  document.getElementById('guide').style.display = "block";
}
// close guide
function close_guide() {
  if ($(document).width() < 321) {
      $(".menu_sub").hide();
  };
  if ($(document).width() < 801) {
      $(".menu_sub").hide();
  };
  document.getElementById('guide').style.display = "none";
}
// xư ly active voice
var play_audio = false;
var audioElement = document.createElement('audio');

function setDataPlayAudio(id, voice) {
  play_audio = false;
  audioElement.setAttribute('src', voice);
}

function playAudio(id, voice) {
  console.log(voice);


  if (play_audio == false) {

      audioElement.setAttribute('src', voice);
      audioElement.play();
      $(`.icon_play_${id}`).removeClass('fa-play');
      $(`.icon_play_${id}`).addClass('fa-pause');
  } else {
      audioElement.pause();

      $(`.icon_play_${id}`).addClass('fa-play');
      $(`.icon_play_${id}`).removeClass('fa-pause');
  }

  play_audio = !play_audio;
}

function resetAudio() {
  play_audio = false;
  $(`.icon_play`).addClass('fa-play');
  $(`.icon_play`).removeClass('fa-pause');
  audioElement.setAttribute('src', "");
  console.log("reset dataa");
}

// xử lý fullscreen
function toggleFullscreen() {
  if (!document.fullscreenElement && // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) { // current working methods
      if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen();
      } else if (document.documentElement.msRequestFullscreen) {
          document.documentElement.msRequestFullscreen();
      } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      }
  } else {
      if (document.exitFullscreen) {
          document.exitFullscreen();
      } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
      } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
      }
  }
}
// xử lý share link
const button = document.querySelector('#icon_sharelink')
button.onclick = () => {
navigator.clipboard.writeText(window.location.href);
}

$(document).ready(function(){
setTimeout(function() {
  $(".thumblist").slideToggle();
  $(".menu_sliderbar").addClass('hide_menu_tour');
}, 5000);

});
