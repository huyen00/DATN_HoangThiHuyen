// xử lý voice
(function ($) {
  embedpano({
    swf: "/" + tour.path + "/tour.swf",
    xml: "/" + tour.path + "/tour.xml",
    target: "pano",
    html5: "only",
    mobilescale: 1.0,
    passQueryParameters: true,
    onready: krpanoReady,
    initvars: {
        editor: editor,
        pano : tour.panos
    }
  });
  function activeText(){
        console.log("aaaaaaa");
    }

  function krpanoReady(krpano) {
    $(".background_sound").on("click", function (e) {
      e.preventDefault();
      $(".background_sound").hide();
      $("#change_sound").hide();

  });
      $("#icon_unmute").hide();
      $("#icon_mute").on("click", function (e) {
          e.preventDefault();
          $(".background_sound").show();
          $("#change_sound").show();
          // $("#icon_unmute").show();
          // $("#icon_mute").hide();
          $("#sound1").removeClass('active');
          $("#sound2").removeClass('active');
      });
      $("#icon_unmute").on("click", function (e) {
          e.preventDefault();

          $("#change_sound").show();
          $(".background_sound").show();
          // $("#icon_mute").show();
          // $("#icon_unmute").hide();
          // krpano.call("resumesound()");
      });
      $("#text_mute").hide();
      $("#text_unmute").on("click", function (e) {
        e.preventDefault();
        $("#change_sound").hide();

        $("#icon_mute").hide();
        $("#icon_unmute").show();

        $("#text_unmute").hide();
        $("#text_mute").show();
        krpano.call("pause_sound()");
    });
    $("#text_mute").on("click", function (e) {
      e.preventDefault();
      $("#change_sound").hide();


      $("#icon_unmute").hide();
      $("#icon_mute").show();

      $("#text_mute").hide();
      $("#text_unmute").show();
      krpano.call("resumesound()");
  });


    // nhac nen
    $("#sound1").on("click", function (e) {
      e.preventDefault();
      $("#change_sound").hide();

      $("#sound2").removeClass('active');
      $("#sound1").addClass('active');
      $("#icon_mute").show();
      $("#icon_unmute").hide();

      $("#text_mute").hide();
      $("#text_unmute").show();

      krpano.call("play_sound1()");
    });
    $("#sound2").on("click", function (e) {
      e.preventDefault();
      $("#change_sound").hide();

      $("#sound1").removeClass('active');
      $("#sound2").addClass('active');
      $("#icon_mute").show();
      $("#icon_unmute").hide();

      $("#text_mute").hide();
      $("#text_unmute").show();

      krpano.call("play_sound2()");
    });

    // mute ở mobile
    $("#icon_unmute1").hide();
    $("#icon_unmute1").on("click", function (e) {
      e.preventDefault();
      console.log(krpano);
      $("#icon_unmute1").show();
      $("#icon_mute1").hide();
      krpano.call("pause_sound()");
    });
  // next scene
  $("#next_scene").click(function(){
    krpano.call("nextscene()");
  });
  $("#prev_scene").click(function(){
    krpano.call("prevscene()");
  });
  // xu ly VR
  $("#icon_VR").on("click", function(e){
    krpano.call("webvr.enterVR()");
  });

 // xu ly back scene

  $("#icon_backscene").on("click",function(e){
    krpano.call("back_scene_project()");
  });
  // ondownmouse, mouseup btn left
  $("#icon_btn_left").on("mousedown",function(e){
    krpano.call("btn_left_ondown()");
  });
  $("#icon_btn_left").on("mouseup",function(e){
    krpano.call("btn_left_onup()");
  });
  // ondownmouse, mouseup btn right
  $("#icon_btn_right").on("mousedown",function(e){
    krpano.call("btn_right_ondown()");
  });
  $("#icon_btn_right").on("mouseup",function(e){
    krpano.call("btn_left_onup()");
  });
    // ondownmouse, mouseup btn up
  $("#icon_btn_up").on("mousedown",function(e){

    krpano.call("btn_up()");
  });
  $("#icon_btn_up").on("mouseup",function(e){
    krpano.call("btn_up_onup()");
  });
    // ondownmouse, mouseup btn down
    $("#icon_btn_down").on("mousedown",function(e){
      krpano.call("btn_down_ondown()");
    });
    $("#icon_btn_down").on("mouseup",function(e){
      krpano.call("btn_down_onup()");
    });
    // ondownmouse, mouseup btn zoom in
    $("#icon_btn_zoomin").on("mousedown",function(e){
      krpano.call("btn_zoomin_ondown()");
    });
    $("#icon_unrotate1").on("click",function(e){
      $("#icon_unrotate1").hide();
      $("#icon_rotate1").show();
      krpano.call("toggleRotate()");
    });
    // xử lý tắt bật xoay
    $("#icon_unrotate").hide();
    $("#icon_rotate").on("click",function(e){
      $("#icon_unrotate").show();
      $("#icon_rotate").hide();
      krpano.call("toggleRotate()");
    });
    $("#icon_unrotate").on("click",function(e){
      $("#icon_unrotate").hide();
      $("#icon_rotate").show();
      krpano.call("toggleRotate()");
    });
     // xu ly show/hide hotspot
      $("#text_hotspot_Close").on("click",function(e){
        $("#text_hotspot_open").removeClass('active');
        $("#text_hotspot_Close").addClass('active');
        krpano.call("hideallhotspots()");
        krpano.call("pause_sound()");
      });
      $("#text_hotspot_open").on("click",function(e){
        $("#text_hotspot_Close").removeClass('active');
        $("#text_hotspot_open").addClass('active');
        krpano.call("showallhotspot()");
      });
    // next scene
    $("#next_scene").click(function(){
      krpano.call("nextscene()");
    });
    $("#prev_scene").click(function(){
      krpano.call("prevscene()");
    });
    // xu ly VR
    $("#icon_VR").on("click", function(e){
      krpano.call("webvr.enterVR()");
    });


    // ondownmouse, mouseup btn left
    $("#icon_btn_left").on("mousedown",function(e){
      krpano.call("btn_left_ondown()");
    });
    $("#icon_btn_left").on("mouseup",function(e){
      krpano.call("btn_left_onup()");
    });
    // ondownmouse, mouseup btn right
    $("#icon_btn_right").on("mousedown",function(e){
      krpano.call("btn_right_ondown()");
    });
    $("#icon_btn_right").on("mouseup",function(e){
      krpano.call("btn_left_onup()");
    });
      // ondownmouse, mouseup btn up
    $("#icon_btn_up").on("mousedown",function(e){

      krpano.call("btn_up()");
    });
    $("#icon_btn_up").on("mouseup",function(e){
      krpano.call("btn_up_onup()");
    });
      // ondownmouse, mouseup btn down
      $("#icon_btn_down").on("mousedown",function(e){
        krpano.call("btn_down_ondown()");
      });
      $("#icon_btn_down").on("mouseup",function(e){
        krpano.call("btn_down_onup()");
      });
      // ondownmouse, mouseup btn zoom in
      $("#icon_btn_zoomin").on("mousedown",function(e){
        krpano.call("btn_zoomin_ondown()");
      });
      $("#icon_btn_zoomin").on("mouseup",function(e){
        krpano.call("btn_zoomin_onup()");
      });
      // ondownmouse, mouseup btn zoom out
      $("#icon_btn_zoomout").on("mousedown",function(e){
        krpano.call("btn_zoomout_ondown()");
      });
      $("#icon_btn_zoomout").on("mouseup",function(e){
        krpano.call("btn_zoomout_onup()");
      });
      // active thumb template 3
      $(".owl-item").removeClass("active");
      $(".item").click(function(e){
        var link_scene = $(this).attr('id');
        var elems_thumbs = document.querySelectorAll(".active");
        [].forEach.call(elems_thumbs, function(el) {
          el.classList.remove("active");
        });
        $(this).addClass("active");
        krpano.call("load_scene(" +link_scene + ")");
      });
       // tong the
       $(".item_tongthe").click(function(e){
        var link_scene = $(this).attr('id');
        var elems_thumbs = document.querySelectorAll(".active");
        [].forEach.call(elems_thumbs, function(el) {
          el.classList.remove("active");
        });
        $(this).addClass("active");
        krpano.call("load_scene(" +link_scene + ")");
      });


    // menu_bottom
    $('.arrow-left').click(function(event){

          $(".menu_sliderbar").removeClass('show_menu_tour');
          $(".logo_tour").css("display","block");
          $(".logo_tour").addClass("transform_logo");
          $(".menu_sliderbar").toggleClass('hide_menu_tour');
          $('.arrow-right').show();
          $('.arrow-left').hide();
      });
      $('.arrow-right').click(function(event){
          $(".logo_tour").css("display","none");
           $(".menu_sliderbar").removeClass('hide_menu_tour');
          $(".menu_sliderbar").toggleClass('show_menu_tour');
          $('.arrow-left').show();
          $('.arrow-right').hide();
      });
      $("#close_menu_bottom").click(function(){
          $(".menu_bottom").slideToggle();
          $(".thumblist").hide();
          $("#show_menu_bottom").show();
      });
      $("#show_menu_bottom").click(function(){
          $(".menu_bottom").slideToggle();
          $("#show_menu_bottom").hide();

      });
      $("#show_thumbs").click(function(){
          $(".thumblist").slideToggle();
      });


      // xu ly scene

      $("#icon_back").on("click",function(e){
        krpano.call("back_scene()");
      });
      // xu ly show/hide hotspot
      $("#hotspot_open").hide();
      $("#hotspot_Close").on("click",function(e){
        $("#hotspot_open").show();
        $("#hotspot_Close").hide();
        krpano.call("hideallhotspots()");
      });
      $("#hotspot_open").on("click",function(e){
        $("#hotspot_open").hide();
        $("#hotspot_Close").show();
        krpano.call("showallhotspot()");
      });
      function updateHotspot(){
        var current_scene = String(krpano.get("scene[get(xml.scene)].title"));
        var current_scene_voice = String(krpano.get("scene[get(xml.scene)].onstart"));
        var data = getListHotSpot(current_scene);
         console.log(current_scene );
         console.log(current_scene_voice );
      }

    //   var list_hotspot = {!! json_encode($list_hotspot_first) !!}
      changeHotspot(list_hotspot);
          function changeHotspot(hotspot) {
              console.log("ngaaaa");
              krpano.call("set(scene[get(xml.scene)].onstart, assets/testB.mp3)");
                  krpano.call("set(hotspot[" + hotspot.name + "].ath, " + hotspot.ath +")");
                  krpano.call("set(hotspot[" + hotspot.name + "].atv, " + hotspot.atv +")");

                  if( hotspot.style == 'Iconcallout_pano_left' || hotspot.style == 'Iconcallout_pano_right'){
                    krpano.call("set(hotspot[" + hotspot.name + "].content, " + hotspot.html +")");
                  }else{
                    krpano.call("set(hotspot[" + hotspot.name + "].html, " + hotspot.html +")");
                  }
                if( hotspot.style != 'skin_hotspotstyle' ){
                    //    krpano.call("assignstyle(hotspot["+ hotspot.name+"]," + hotspot.icon.name +");");
                    if(hotspot.onhover != null && hotspot.style != 'skin_hotspotstyle' ){
                        krpano.call("set(hotspot[" + hotspot.name + "].onhover, " + hotspot.onhover +")");
                    }
                    if(hotspot.onclick != null && hotspot.style != 'skin_hotspotstyle'){
                        krpano.call("set(hotspot[" + hotspot.name + "].onclick, " + hotspot.onclick +")");
                        console.log(hotspot.name);
                        console.log(hotspot.onclick);
                    }
                }
          }
          function getListHotSpot(scene){
            var url_edit = "/tour/" + tour.code + "/hotspot/" + scene;
            // console.log(url_edit);
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            // POST to server using $.post or $.ajax
            $.ajax({
                data: {
                    scene: scene,
                    },
                type: 'GET',
                dataType: 'json',
                url: `/tour/${tour.code}/hotspot/${scene}`,
                error: function(err) {
                    console.log(err);
                },
                success: function(data) {
                    console.log(data);
                    let keys = Object.keys(data);

                    var list_hotspot = data[keys[0]].hotspots;
                    console.log(list_hotspot);
                    for(i=0; i < list_hotspot.length ; i++){
                        changeHotspot(list_hotspot[i]);
                    }
                }
            });
          }
          function getvoicescene(){
            
          }

        // xu ly active khi click
        $(".item").click(function(e){
            var link_scene = $(this).attr('id');
            console.log(link_scene);

            var elems = document.querySelectorAll(".active");
            [].forEach.call(elems, function(el) {
              el.classList.remove("active");

            });
            var elems = document.querySelectorAll(".active_menu");
              [].forEach.call(elems, function(el) {
                el.classList.remove("active_menu");

              });

            $(this).addClass("active");
            $(this).removeClass("active_menu");
            //console.log($(this).attr('id'));
            let target_active_menu = "#" + $(this).attr('id')
            var elems_active_menu = document.querySelectorAll(target_active_menu);
              [].forEach.call(elems_active_menu, function(el) {
                el.classList.add("active_menu");

              });
            krpano.call("load_scene(" +link_scene + ")");
            updateHotspot();
          });


          // xu lys show scene menu
          $(".item_sub").click(function(e){
            var link_scene = $(this).attr('id');

            var elems = document.querySelectorAll(".active_menu");
            [].forEach.call(elems, function(el) {
              el.classList.remove("active_menu");

            });
            var elems_thumbs = document.querySelectorAll(".active");
            [].forEach.call(elems_thumbs, function(el) {
              el.classList.remove("active");

            });
            let target_active = "#" + $(this).attr('id');
            var elem_active = document.querySelectorAll(target_active);
            [].forEach.call(elem_active, function(el) {
              el.classList.add("active");

            });
            $(this).addClass("active_menu");
            $(this).removeClass("active");

            krpano.call("load_scene(" +link_scene + ")");
            updateHotspot();
          });
          // Template 2 - menu top
          // show title scene khi click menu html
          function getSceneTitleName() {
            var title = String(krpano.get("scene[get(xml.scene)].title"));
            console.log("title =" + title);
            $("#name_scene").html(title);
          };
          // xu ly active khi click
          $(".item_sub_top").click(function(e){
            var link_scene = $(this).attr('id');
            console.log(link_scene);

            var elems = document.querySelectorAll(".active");
            [].forEach.call(elems, function(el) {
              el.classList.remove("active");

            });
            var elems = document.querySelectorAll(".active_menu");
              [].forEach.call(elems, function(el) {
                el.classList.remove("active_menu");

              });

            $(this).addClass("active");
            $(this).removeClass("active_menu");
            //console.log($(this).attr('id'));
            let target_active_menu = "#" + $(this).attr('id')
            var elems_active_menu = document.querySelectorAll(target_active_menu);
              [].forEach.call(elems_active_menu, function(el) {
                el.classList.add("active_menu");

              });
            krpano.call("load_scene(" +link_scene + ")");
          getSceneTitleName();
          updateHotspot();
          });
        // xu lys show scene menu
        $(".link_mobile").click(function(e){
          var link_scene = $(this).attr('id');

          var elems = document.querySelectorAll(".active_menu");
          [].forEach.call(elems, function(el) {
            el.classList.remove("active_menu");

          });
          var elems_thumbs = document.querySelectorAll(".active");
          [].forEach.call(elems_thumbs, function(el) {
            el.classList.remove("active");

          });
          let target_active = "#" + $(this).attr('id');
          var elem_active = document.querySelectorAll(target_active);
          [].forEach.call(elem_active, function(el) {
            el.classList.add("active");

          });
          // $(this).addClass("active_menu");
          $(this).removeClass("active");

          krpano.call("load_scene(" +link_scene + ")");
          $(".menu_top_mobile").hide();
          getSceneTitleName();
          updateHotspot();
        });
        //   show scene item album
        $(".item_album").click(function(e){
          var link_scene = $(this).attr('id');
          console.log(link_scene);

          var elems = document.querySelectorAll(".active");
          [].forEach.call(elems, function(el) {
            el.classList.remove("active");

          });
          var elems = document.querySelectorAll(".active_menu");
            [].forEach.call(elems, function(el) {
              el.classList.remove("active_menu");

            });

          $(this).addClass("active");
          $(this).removeClass("active_menu");

          let target_active_menu = "#" + $(this).attr('id')
          var elems_active_menu = document.querySelectorAll(target_active_menu);
            [].forEach.call(elems_active_menu, function(el) {
              el.classList.add("active_menu");

            });
          krpano.call("load_scene(" +link_scene + ")");
          getSceneTitleName();
          updateHotspot();
          $("#album_thumb").hide();
        });


          // xu ly minimap
          $(".panWrapper").mousedown(function(e){
            e.preventDefault();

           $(".panWrapper").hide();
            krpano.call("showmap()");

          });

          $("#btn_Savexml").click(function(e)
          {
            var list_hotspot = [];
            var scene = [];
            var hotspot_count = krpano.get('hotspot.count');
            var index_scene = krpano.get('scene[get(xml.scene)].index');
            var scene_name = krpano.get('xml.scene');
            var scene_count = krpano.get('scene.count');
                for(i = 0; i < hotspot_count; i++){
                   // krpano.set('hotspot[' + i + '].alpha', 0.5);
                    var hotspot = krpano.get('hotspot[ ' + i + ']');
                        if(hotspot.url != null){
                            var hotspot_filter =
                            {
                                "id" : hotspot.id,
                                "name" : hotspot.name,
                                "ath" : hotspot.ath,
                                "atv" : hotspot.atv,
                                "url" : hotspot.url,
                                "onhover" : hotspot.onhover,
                                "style" : hotspot.style
                            };

                        }else{
                            var hotspot_filter =
                            {
                                "name" : hotspot.name,
                                "style" : hotspot.style
                            };
                        }
                        list_hotspot.push(hotspot_filter);
                }
                scene= {};

                scene['id'] = index_scene;
                scene['scene_name'] = scene_name;
                scene['hotspot'] = list_hotspot;
            // }

            // console.log('list_hotspot',list_hotspot);
             console.log('scene',scene);

            var url_edit = "/tour_editor/" + tour.code;
            // console.log(url_edit);
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            // POST to server using $.post or $.ajax
            $.ajax({
                data: {
                    scene: scene,
                    },
                type: 'POST',
                url: `/tour_editor/${tour.code}`,
                error: function(err) {
                    console.log(err);
                },
                success: function(data) {
                    console.log(data);
                }
            });
          });

          }
        })(jQuery);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myFunction(this);
                }
            };
            xhttp.open("GET", "tour2.xml", true);
            xhttp.send();

            function myFunction(xml) {
                var x, y, cloneNode, i, xmlDoc, txt;
                xmlDoc = xml.responseXML;
                txt = "";
                x = xmlDoc.getElementById('pano')[0];
                cloneNode = x.cloneNode(true);
                xmlDoc.documentElement.appendChild(cloneNode);

                // Output all titles
                y = xmlDoc.getElementsByTagName("title");
                for (i = 0; i < y.length; i++) {
                    txt += y[i].childNodes[0].nodeValue + "<br>";
                }
                document.getElementById("demo").innerHTML = txt;
            }