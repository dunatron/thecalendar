/**
 * Created by Heath on 29/08/16.
 */
/**
 * Created by Heath on 28/08/16.
 */


// Onclick(event) get attributes e.g. assign lat on lon back on controller
// and thats it set this stuff on the controller
var url = window.location.href;
// MAINURL = url + "home/TronsGrandTest";
MAINURL = url + 'home';

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
        markerIcon: 'mysite/images/svg/location.svg'
    });

    var EVENTID = $(this).attr("eid");

    // Set EventTitle
    $.ajax({
       type:"POST",
        url: MAINURL+'/EventTitle',
        data: {EventID:EVENTID},
        success:function (response){
            $('.modal-title').html(response);
        }
    });
    //EventImages
    $.ajax({
        type:"POST",
        url: MAINURL+'/associatedEventData',
        data: {EventID:EVENTID},
        success:function (response){
            $('.event-assocData').html(response);
        }
    });
    // Modal Dialog control | reference
    $('#ApprovedEventModal').on('shown.bs.modal', function () {
        $('#eventMap1').locationpicker('autosize');
        modalIsOpen();
    });

});

$('#ApprovedEventModal').on('hidden.bs.modal', function () {
    modalIsClosed();
    $.ajax({
        type:"POST",
        url: MAINURL+'/resetApprovedModal',
        success:function (response){
            $('.event-assocData').html(response);
        }
    });
});

function modalIsOpen() {
    $('html').addClass('modal-open');
}

function modalIsClosed() {
    // Check if search modal is open
    if($('#SearchModal').hasClass('in')){

    }else {
        $('html').removeClass('modal-open');
    }
}

