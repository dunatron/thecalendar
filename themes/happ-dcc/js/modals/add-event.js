/**
 * Created by admin on 6/12/16.
 */


// $(nextBtn).on('click', function(e){
//
//     e.preventDefault();
//
//     var url = window.location.href;
//
//     // MAINURL = url + "home/TronsGrandTest";
//     MAINURL = url;
//     // Set EventTitle
//     $.ajax({
//         type:"POST",
//         url: MAINURL+'home/next',
//         success:function (response){
//             $('#SteppedEventForm_SteppedEventForm').html(response);
//         }
//     });
//
//     console.log('tried some ajax');
//
// });

// On page reload check what state the modal is in

// $( document ).ready(function() {
//     var nextBtn = $('#SteppedEventForm_SteppedEventForm_action_next'),
//         closeBtn = $('.close-btn'),
//         modalState = $('.modal-checker');
//     console.log( "ready!" );
//     if($(modalState).attr('modal-state') == 0){
//         console.log('Modal state is set tp 0');
//         $('#AddHappEventModal').modal('show');
//     } else {
//         console.log('Modal state is set tp 1');
//     }
// });

$(window).load(function(){
    var nextBtn = $('#SteppedEventForm_SteppedEventForm_action_next'),
        closeBtn = $('.close-btn'),
        modalState = $('.modal-checker');
    console.log( "ready!" );
    if($(modalState).attr('modal-state') == 0){
        console.log('Modal state is set tp 0');
        $('#AddHappEventModal').modal('show');
    } else {
        console.log('Modal state is set tp 1');
    }
});

// $(window).bind('beforeunload',function(){
//
//     //save info somewhere
//
//     return 'are you sure you want to leave?';
//
// });




$(closeBtn).on('click', function(){
    console.log('close btn has been triggered');
    var url = window.location.href;

    // MAINURL = url + "home/TronsGrandTest";
    MAINURL = url;
    // Set EventTitle
    $.ajax({
        type:"POST",
        url: MAINURL+'home/CloseModal',
        success:function (response){
            // $('#SteppedEventForm_SteppedEventForm').html(response);
            $('#SteppedEventForm_SteppedEventForm').html(response);
        }
    });
});


