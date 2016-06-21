/**
 * Created by Heath on 23/05/16.
 */
$('#event-date input').datepicker({
    autoclose: true
});

// Close Datepicker when day is picked
$('.calendarpage').on('click', '.day', function (e) {
    $('.datepicker').css("display", "none");
});


$('#event-date input').on('show', function(e){
    console.debug('show', e.date, $(this).data('stickyDate'));

    if ( e.date ) {
        $(this).data('stickyDate', e.date);
    }
    else {
        $(this).data('stickyDate', null);
    }
});

$('#event-date input').on('hide', function(e){
    console.debug('hide', e.date, $(this).data('stickyDate'));
    var stickyDate = $(this).data('stickyDate');

    if ( !e.date && stickyDate ) {
        console.debug('restore stickyDate', stickyDate);
        $(this).datepicker('setDate', stickyDate);
        $(this).data('stickyDate', null);
    }
});