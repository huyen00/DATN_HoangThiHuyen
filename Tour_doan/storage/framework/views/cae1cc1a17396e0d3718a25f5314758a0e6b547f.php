<!DOCTYPE html>
<html>

<head>
    <title>Places Search Box</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSHcL9_vYhjFhEaP3FDIRhBNOYWPju4YU&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            height: 35px;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
            margin-top:  10px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
        }

        #map_maker_content {
            color: red;
            font-family: monospace;
        }

        .map_img {
            max-width: 200px !important;
            height: 100px;
        }
        .gm-style button.gm-control-active.gm-fullscreen-control{
            display: none !important;
        }

        @media  only screen and (max-width: 414px) {
            .map_img {
                max-width: 100px !important;
                height: auto;
            }
        }
        @media  all  and (max-width: 600px) {
            #pac-input {
               display: none;
            }
        }
        @media  all  and (max-width: 480px) {
            #pac-input {
               display: none;
            }
        }
        @media  all  and (max-width: 320px) {
            #pac-input {
               display: none;
            }
        }
    </style>
    <script>
        var map = <?php echo json_encode($map->toArray()); ?>;
        var image = <?php echo json_encode($link_img); ?>

        var title = <?php echo json_encode($tour->name); ?>

        var ln = map['latitude'];
        var lg = map['longtitude'];
        (function(exports) {
            "use strict";

            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
            function initAutocomplete() {
                var service;
                var infowindow;
                var infowindow_from;
                var markers = [];
                var location_start = new google.maps.LatLng(ln, lg);
                var map = new google.maps.Map(document.getElementById("map"), {
                    center: location_start,
                    zoom: 15,
                    mapTypeId: "roadmap"
                }); // Create the search box and link it to the UI element.

                infowindow = new google.maps.InfoWindow({
                    content: `<div id="map_maker_content">  <img class="map_img" src=/${image}></div>`,

                });

                var input = document.getElementById("pac-input");
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // Bias the SearchBox results towards current map's viewport.

                map.addListener("bounds_changed", function() {
                    searchBox.setBounds(map.getBounds());
                });

                // The marker, positioned at sydney
                var marker = new google.maps.Marker({
                    position: location_start,
                    map: map
                });

                infowindow.open(map, marker);
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });

                /*event click map*/
                map.addListener('click', function(event) {
                    console.log(map);
                    deleteMarkers();
                    placeMarker(event.latLng);

                });
                var markers = []; // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.

                map.addListener('click', function(event) {
                    console.log(map);
                    deleteMarkers();
                    placeMarker(event.latLng);

                });

                function setplaceMarker(location, time, total, from, to) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        zoom: 12,
                    });
                    markers.push(marker);
                    var infowindow_from = new google.maps.InfoWindow({
                        content: 'Từ :' + from + '<br> Đến:' + to + '<br> Khoảng cách :' + total + '<br> Thời gian :' + time
                    });
                    infowindow_from.open(map, marker);
                }

                function placeMarker(location) {
                    dogetRedirect_map(location, location_start);
                }
                var directionsService = new google.maps.DirectionsService(); // Khai báo biến<br />
                var directionsDisplay = new google.maps.DirectionsRenderer(); // Khai báo biến

                function dogetRedirect_map(position, roomLatlng) {


                    var request = {
                        origin: position,
                        destination: roomLatlng,
                        travelMode: google.maps.TravelMode.DRIVING,
                        unitSystem: google.maps.UnitSystem.METRIC
                    };
                    directionsDisplay.setMap(map); // map là biến google maps được tạo ở đoạn code bài trước
                    directionsService.route(request, function(response, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setOptions({
                                preserveViewport: true,
                                suppressMarkers: true
                            });
                            directionsDisplay.setDirections(response);
                            var myroute = response.routes[0]; // Kết quả trả về
                            var time = myroute.legs[0].duration.text; // Thời gian duy chuyển
                            var total = myroute.legs[0].distance.text; // Chiều dài đoạn đường duy chuyển
                            var from = myroute.legs[0].start_address; // Điểm xuất phát
                            var to = myroute.legs[0].end_address; // Điểm đến
                            setplaceMarker(position, time, total, from, to);
                            //                        console.log('duong di :' + total + ' thoi gian' + time + 'diem den ' + to);
                        } else {
                            console.log(status);
                        }
                    });
                }
                // Sets the map on all markers in the array.
                function setMapOnAll(map) {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                }

                // Removes the markers from the map, but keeps them in the array.
                function clearMarkers() {
                    setMapOnAll(null);
                }

                // Shows any markers currently in the array.
                function showMarkers() {
                    setMapOnAll(map);
                }

                // Deletes all markers in the array by removing references to them.
                function deleteMarkers() {
                    clearMarkers();
                    markers = [];
                }
                searchBox.addListener("places_changed", function() {
                    var places = searchBox.getPlaces();
                    console.log(places[0].geometry.location);
                    deleteMarkers();
                    placeMarker(places[0].geometry.location);


                });
            }

            exports.initAutocomplete = initAutocomplete;
        })((this.window = this.window || {}));
    </script>
</head>

<body>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
    <div id="map"></div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Tour_doan\resources\views/tour360/map.blade.php ENDPATH**/ ?>