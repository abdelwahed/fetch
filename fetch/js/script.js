$(document).ready(function(){

        var searchType;

        var all = ['food', 'bar', 'cafe', 'park', 'store', 'pet_store', 'veterinary_care'];
        var food = ['food', 'restaurant', 'cafe', 'bakery', 'grocery_or_supermarket', 'meal_takeaway'];
        var bars = ['bar'];
        var coffee = ['cafe'];
        var parks = ['park'];
        var shops = ['store', 'book_store', 'bicycle_store', 'clothing_store', 'department_store', 'electronics_store', 'florist', 'furniture_store', 'hardware_store', 'home_goods_store', 'jewelry_store', 'shopping_mall']; 
        var dogNeeds = ['pet_store', 'veterinary_care']; // terms: pet_store, veterinary_care

        searchType = dogNeeds;

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

// TYPE ICON CLICKS
        $("#foodIcon").click(function() {
            searchType = food;
            // console.log( typeof searchType );
            console.log('%c searchType = food', 'color: blue');
        });
        $("#barsIcon").click(function() {
            searchType = bars;
            console.log('searchType = bars');
        });
        $("#shopsIcon").click(function() {
            searchType = shops;
            console.log('searchType = shops');
        });
        $("#coffeeIcon").click(function() {
            searchType = coffee;
            console.log('searchType = coffee');
        });
        $("#parkIcon").click(function() {
            searchType = parks;
            console.log('searchType = parks');
        });
        $("#dogIcon").click(function() {
            searchType = dogNeeds;
            console.log('searchType = dog needs');
        });

// MAPPING
    
    // Google API Key: AIzaSyAtkpcLyTqPcP4K64ykd6Gdq7y2rx1aufo

        var map;
        var city = new google.maps.LatLng(29.7580,-95.3698); //Houston
        // api can return based on "locality," postcode, neighborhood

    // CHANGE TYPE TITLE ON MAP
        if(searchType === all) {
            $( ".typeTitleMap" ).append( "<h1>ALL</h1>" );
            console.log('all');
        }
        if(searchType === food) {
            $( ".typeTitleMap" ).append( "<h1>FOOD</h1>" );
            console.log('food');
        }
        if(searchType === bars) {
            $( ".typeTitleMap" ).append( "<h1>BARS</h1>" );
            console.log('bars');
        }
        if(searchType === coffee) {
            $( ".typeTitleMap" ).append( "<h1>COFFEE</h1>" );
            console.log('coffee');
        }
        if(searchType === parks) {
            $( ".typeTitleMap" ).append( "<h1>PARKS</h1>" );
            console.log('parks');
        }
        if(searchType === shops) {
            $( ".typeTitleMap" ).append( "<h1>SHOPS</h1>" );
            console.log('shops');
        }
        if(searchType === dogNeeds) {
            $( ".typeTitleMap" ).append( "<h1>DOG NEEDS</h1>" );
            console.log('dog needs');
        }

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
                zoom: 12,
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
                radius: '99999', // meters
                types: searchType,
                query: 'dog'
            };

            service = new google.maps.places.PlacesService(map);
            service.textSearch(request, callPlaces);
            service.getDetails(request, callPlaces);
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

        var placeId;
        var placeName;
        var placeRating;
        var placeWebsite;
        var placeAddress;
        var placePhoneNumber;

        var marker;
        var infos = [];

        function callPlaces(results, status) {
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
                    placeId = results[i].place_id;
                    placeName = results[i].name;
                    placeRating = results[i].rating;
                    placeWebsite = results[i].website;
                    placeAddress = results[i].formatted_address;
                    placePhoneNumber = results[i].formatted_phone_number;

                    // console.log(placeAddress);

        
                    var infoWindowContent = '<div id="content">'+'<div id="siteNotice">'+'</div>'+
                        '<h5 id="placeNameHeadingMap">' + placeName + '</h5>'+'<div id="placeRatingMap">'+
                        '<p>Rating: ' + placeRating + '</p>'+'</div>'+'</div>';

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