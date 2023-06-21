"use strict";

const inputLat = $("#input-lat");
const inputLng = $("#input-lng");

const map = new GMaps({
    div: '#map',
    lat: inputLat.val() === '' ? -6.5637928 : parseFloat(inputLat.val()),
    lng: inputLng.val() === '' ? 106.7535061 : parseFloat(inputLng.val())
});

const marker = map.addMarker({
    lat: inputLat.val() === '' ? -6.5637928 : parseFloat(inputLat.val()),
    lng: inputLng.val() === '' ? 106.7535061 : parseFloat(inputLng.val()),
    draggable: true,
});

map.addListener("click", function (e) {
    const lat = e.latLng.lat(),
        lng = e.latLng.lng();

    marker.setPosition({
        lat: lat,
        lng: lng
    });
    updatePosition();
});

marker.addListener('drag', function (e) {
    updatePosition();
});

updatePosition();

function updatePosition() {
    const lat = marker.getPosition().lat(), lng = marker.getPosition().lng();
    inputLat.val(lat);
    inputLng.val(lng);
}
