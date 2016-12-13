/**
 * Created by admin on 14/12/16.
 */
$( document ).ready(function() {
    console.log( "Ready to start adding events with out new jquery form" );

    var DetailsNext = $('#detailsNextBtn');
    var TicketCheck = $('#hasTickets');
    var DetailsWrapper = $('#details-step');
    var TicketWrapper = $('#ticket-step');

    $(DetailsNext).on('click', function(){
        console.log( "Next details has been clicked" );
        if($(TicketCheck).is(':checked')){
            console.log( "Tis checked" );
            showTicketStep();
        }else {

        }
    });
    
    function showDetailsStep() {
        
    }
    
    function hideDetailsStep() {

    }

    function showTicketStep()
    {
        console.log( "showing ticket step" );
        $(DetailsWrapper).addClass('field-hidden');
        $(TicketWrapper).removeClass('field-hidden');
    }
    
    function hideTicketStep() {
        console.log( "hiding ticket step" );
        $(TicketWrapper).addClass('field-hidden');
    }
});