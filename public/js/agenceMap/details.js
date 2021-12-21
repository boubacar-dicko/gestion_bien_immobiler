function initMap() {
    var latitude = document.getElementById("latitude").value
    var longitude = document.getElementById("longitude").value
    let lat  = parseFloat(latitude)
    let long  = parseFloat(longitude)
    const myLatLng = { lat: lat, lng: long };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 18,
        center: myLatLng,
    });

    new google.maps.Marker({
        position: myLatLng,
        map,
    });
}