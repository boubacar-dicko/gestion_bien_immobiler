var map, infoWindow;
var geocoder;
function initMap() {

    // Display a map on the page
    const map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.865143, lng: 151.209900},
        mapTypeId: 'roadmap',
        zoom: 14
    });

    map.setTilt(45);

    // Try HTML5 geolocation to get location
    infoWindow = new google.maps.InfoWindow;
    geocoder = new google.maps.Geocoder;
    /*var  input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(
        input, {placeIdOnly: true});
    autocomplete.bindTo('bounds', map);*/


//
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                draggable: true,
                title: 'Your position'
            });
            /*infoWindow.setPosition(pos);
            infoWindow.setContent('Your position');
            marker.addListener('click', function() {
              infoWindow.open(map, marker);
            });
            infoWindow.open(map, marker);*/
            map.setCenter(pos);

            updateMarkerPosition(marker.getPosition());
            geocodePosition(pos);

            // Add dragging event listeners.
            google.maps.event.addListener(marker, 'dragstart', function() {
                updateMarkerAddress('Dragging...');
            });

            google.maps.event.addListener(marker, 'drag', function() {
                updateMarkerStatus('Dragging...');
                updateMarkerPosition(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                updateMarkerStatus('Drag ended');
                geocodePosition(marker.getPosition());
                map.panTo(marker.getPosition());
            });

            google.maps.event.addListener(map, 'click', function(e) {
                updateMarkerPosition(e.latLng);
                geocodePosition(marker.getPosition());
                marker.setPosition(e.latLng);
                map.panTo(marker.getPosition());
            });

        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    //
    /*autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();

        if (!place.place_id) {
            return;
        }
        geocoder.geocode({'placeId': place.place_id}, function (results, status) {

            if (status !== 'OK') {
                window.alert('Geocoder failed due to: ' + status);
                return;
            }
            map.setZoom(10);
            map.setCenter(results[0].geometry.location);
            // Set the position of the marker using the place ID and location.

        });
    });*/
}

//
function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            updateMarkerAddress(responses[0].formatted_address);
        } else {
            //updateMarkerAddress('Cannot determine address at this location.');
        }
    });
}
function updateMarkerStatus(str) {
    //  document.getElementById('markerStatus').innerHTML = str;
}
function updateMarkerPosition(latLng) {
    $("#bien_immobilier_latitude").val(latLng.lat());
    $("#bien_immobilier_longitude").val(latLng.lng());

}
/*function updateMarkerAddress(str) {
    $("#address").val(str);
}*/
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}