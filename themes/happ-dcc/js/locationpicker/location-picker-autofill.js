/**
 * Created by Heath on 28/08/16.
 */
// eventMap | div element
$('#eventMap').locationpicker({
    location: {
        latitude: -45.8751791,
        longitude: 170.5031467
    },
    radius: 300,
    inputBinding: {
        latitudeInput: $('#addEventLat'),
        longitudeInput: $('#addEventLon'),
        radiusInput: $('#addEventRadius'),
        locationNameInput: $('#addEventAddress')
    },
    enableAutocomplete: true,
    markerIcon: 'https://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png'
});
// Modal Dialog control | reference
$('#AddHappEventModal').on('shown.bs.modal', function () {
    $('#eventMap').locationpicker('autosize');
});

$('#addEventMap').locationpicker({
    location: {
        latitude: -45.8751791,
        longitude: 170.5031467
    },
    radius: 300,
    inputBinding: {
        latitudeInput: $('#addEventLat'),
        longitudeInput: $('#addEventLon'),
        radiusInput: $('#addEventRadius'),
        locationNameInput: $('#addEventAddress')
    },
    enableAutocomplete: true,
    markerIcon: 'https://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png'
});