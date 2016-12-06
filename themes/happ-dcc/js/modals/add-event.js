/**
 * Created by admin on 6/12/16.
 */


$(window).load(function(){
    var nextBtn = $('#SteppedEventForm_SteppedEventForm_action_next'),
        modalState = $('.modal-checker'),
        eventModal = $('#AddHappEventModal');

    $(eventModal).on('hidden.bs.modal', function (e) {
        console.log('close btn has been triggered by bootstrap');
        var url = $('#siteBaseUrl').attr('href');

        // MAINURL = url + "home/TronsGrandTest";
        MAINURL = url;
        // Set EventTitle
        $.ajax({
            type:"POST",
            url: url+'home/CloseModal',
            success:function (response){
                // $('#SteppedEventForm_SteppedEventForm').html(response);
                $('#modal-status').html(response);
            }
        });
    });


    if($(modalState).attr('modal-state') == 1){
        console.log('Modal state is set tp 1');
        $(eventModal).modal('show');
    } else {
        console.log('Modal state is set tp 0');
    }

    $(eventModal).on('show.bs.modal', function (e) {
        console.log('giding the event modal when it is close... set session back to 0 champ')
    });

    $(eventModal).on('shown.bs.modal', function (e) {
        // do something...
        console.log('giding the event modal when it is close... set session back to 0 champ')
    });

});






