$(document).ready(function(){

// STICKY HEADER
        var stickyHeaderTop = $('.navbar').offset().top;

        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('.navbar').css({position: 'fixed', top: '0px'})
                } else {
                        $('.navbar').css({position: 'static', top: '0px'});
                }
        });
// NAVIGATION
        // NAV BAR CLICK
        $("#typeNav").click(function() {
            $('html, body').animate({   
            scrollTop: $("#browseType").offset().top
            }, 1000);
        });
        $("#tennisball").click(function() {
            $('html, body').animate({   
            scrollTop: $("#home").offset().top
            }, 1000);
        });

        //HAMBURGER ICON HOVER
        $("#hamburger_icon").mouseenter(function() {
            $("#hamburger_top").css("top", "2px");
            $("#hamburger_bottom").css("top", "20px");
        });
        $("#hamburger_icon").mouseleave(function() {
            $("#hamburger_top").css("top", "0px");
            $("#hamburger_bottom").css("top", "22px");
        });

// MAPPING
    
    // Google API Key: AIzaSyAtkpcLyTqPcP4K64ykd6Gdq7y2rx1aufo

        var map;
        var city = new google.maps.LatLng(29.7604,-95.3698); //Houston
        // api can return based on "locality," postcode, neighborhood

        var allFood; // terms: restaurant, cafe, bakery, food, 
            // grocery_or_supermarket, meal_takeaway
        var allBars; // term: bar
        var allCoffee; // terms: cafe
        var allParks; // terms: campground, park, stadium
        var allShopping; // terms: book_store, bicycle_store, 
            // clothing_store, department_store, 
            // electronics_store, florist, furniture_store, 
            // hardware_store, home_goods_store
            // jewelry_store, shopping_mall, store
        var allDogNeeds; // terms: pet_store, veterinary_care

        //initialize map into the "map" div
        function initializeMap() {
            
            // style for map
            var styles = [
                {
                  stylers: [
                    { hue: "#00ffe6" },
                    { saturation: -20 }
                  ]
                },{
                  featureType: "road",
                  elementType: "geometry",
                  stylers: [
                    { lightness: 100 },
                    { visibility: "simplified" }
                  ]
                },{
                  featureType: "road",
                  elementType: "labels",
                  stylers: [
                    { visibility: "off" }
                  ]
                }
            ];
            var styledMap = new google.maps.StyledMapType(styles,
                {name: "Styled Map"});

            var mapOptions = {
                center: city,
                zoom: 15,
                scrollwheel: false,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }
            };

            map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');

            var request = {
                location: city,
                radius: '5000', // meters
                query: ['dogs', 'bar']
            };

            service = new google.maps.places.PlacesService(map);
            service.textSearch(request, callback);
            service.getDetails(request, callDetails);
                // can get: geometry.location
                // name
                // formatted_address, formatted_phone_number
                // opening_hours.day, opening_hours.time
                // photos[] array of PlacePhoto: use with getUrl() method
                // reviews (up to 5) aspects[] contains an array of PlaceAspectRating objects: type & rating
                // place_id
                // website
        }
    // ON LOAD OF PAGE, CALL INITIALIZE MAP FUNCTION
        google.maps.event.addDomListener(window, 'load', initializeMap);
        // initializeMap();

        var placeName;
        var placeRating;
        var marker;
        var infos = [];

        function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    var place = results[i];
                    marker = new google.maps.Marker({
                        map: map,
                        animation: google.maps.Animation.DROP,
                        place: {
                            placeId: results[i].place_id,
                            location: results[i].geometry.location,
                        }
                    });
                    placeName = results[i].name;
                    placeRating = results[i].rating;
        
                    var infoWindowContent = '<div id="content">'+'<div id="siteNotice">'+'</div>'+
                        '<h5 id="placeNameHeadingMap">' + placeName + '</h5>'+'<div id="placeRatingMap">'+
                        '<h5>' + placeRating + '</h5>'+'</div>'+'</div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: infoWindowContent
                    });

                    google.maps.event.addListener(marker,'click',(function(marker,infoWindowContent,infowindow) {
                        console.log('merp');
                        // infowindow.open(map, marker);
                        return function() {
                            closeInfos();
                            infowindow.setContent(infoWindowContent);
                            infowindow.open(map,marker);
                            infos[0]=infowindow;
                        };
                    })(marker,infoWindowContent,infowindow));

                }
            }
        }
        function closeInfos(){
                /* If there are infoWindows open on the map */
            if(infos.length > 0){    
                /* detach the info-window from the marker */
                infos[0].set("marker", null);
                /* and close it */
                infos[0].close();
                /* blank the array */
                infos.length = 0;
            }
        }


  });
//init
// var init = function() {
//     console.log('Bobo');
//     initializeMap();
    
// };

// //load listener
// $(document).ready(init);