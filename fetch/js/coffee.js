$(document).ready(function(){

    console.log('coffee');

	var map;
    var city = new google.maps.LatLng(29.7580,-95.3698); //Houston

    $( ".typeTitleMap" ).append( "<h1>COFFEE</h1>" );

    //initialize map into the "map" div
    function initializeMap() {
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
                radius: '5000', // meters
                types: ['cafe'],
                query: 'dog'
            };

            service = new google.maps.places.PlacesService(map);
            service.textSearch(request, callPlaces);
    }

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


                    console.log(results[i]);
                    // console.log(placeAddress);

        
                    var infoWindowContent = '<div id="content">'+'<div id="siteNotice">'+'</div>'+
                        '<h5 id="placeNameHeadingMap">' + placeName + '</h5>'+'<div id="placeRatingMap">'+
                        '<p>' + placeAddress + '</br>Rating: '+ placeRating + '</p>'+'</div>'+'</div>';

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
        if(infos.length > 0){    
        	infos[0].set("marker", null);
        	infos[0].close();
        	infos.length = 0;
    	}
    }


    google.maps.event.addDomListener(window, 'load', initializeMap);

});