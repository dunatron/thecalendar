/**
 * Created by Heath on 29/08/16.
 */
/**
 * Created by Heath on 28/08/16.
 */


// Onclick(event) get attributes e.g. assign lat on lon back on controller
// and thats it set this stuff on the controller


$('.event-btn').on("click", function(){
    var target = $(this).attr("data-target");
    var LATITUE = $(this).attr("lat");
    var LONGITUDE = $(this).attr("lon");
    var RADIUS = $(this).attr("radius");
    // ToDO Create AJAX Call To Database to get different elements
    // eventMap | div element
    $('#eventMap1').locationpicker({
        location: {
            latitude: LATITUE,
            longitude: LONGITUDE
        },
        radius: RADIUS,
        enableAutocomplete: true,
        markerIcon: 'https://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png'
    });
// Modal Dialog control | reference
    $('#ApprovedEventModal').on('shown.bs.modal', function () {
        $('#eventMap1').locationpicker('autosize');
    });
});

