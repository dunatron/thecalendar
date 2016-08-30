/**
 * Created by Heath on 29/08/16.
 */
/**
 * Created by Heath on 28/08/16.
 */


// Onclick(event) get attributes e.g. assign lat on lon back on controller
// and thats it set this stuff on the controller


$('.event-btn').on("click", function () {
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

    /*
     Generate event data for modal | AJAX
     */
    // Replace calendar body
    var url = window.location.href;
    var EVENTID = $(this).attr("eid");

    // MAINURL = url + "home/TronsGrandTest";
    MAINURL = url + 'home';
    // Set EventTitle
    $.ajax({
       type:"POST",
        url: MAINURL+'/EventTitle',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-title').html(response);
        }
    });
    // EventDescription
    $.ajax({
        type:"POST",
        url: MAINURL+'/EventDescription',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-description').html(response);
        }
    });
    // EventLocation
    $.ajax({
        type:"POST",
        url: MAINURL+'/EventLocation',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-location').html(response);
        }
    });
    // EventDate
    $.ajax({
        type:"POST",
        url: MAINURL+'/EventDate',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-date').html(response);
        }
    });
    // EventStartTime
    $.ajax({
        type:"POST",
        url: MAINURL+'/EventStartTime',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-startTime').html(response);
        }
    });
    //EventFinishTime
    $.ajax({
        type:"POST",
        url: MAINURL+'/EventFinishTime',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-finishTime').html(response);
        }
    });
    // Modal Dialog control | reference
    $('#ApprovedEventModal').on('shown.bs.modal', function () {
        $('#eventMap1').locationpicker('autosize');
    });
    

});

