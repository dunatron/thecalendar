/**
 * Created by admin on 14/12/16.
 */
$( document ).ready(function() {

    var DetailsNext = $('#detailsNextBtn');
    var TicketCheck = $('#hasTickets');
    var DetailsWrapper = $('#details-step');
    var TicketWrapper = $('#ticket-step');

    $(DetailsNext).on('click', function(){
        if($(TicketCheck).is(':checked')){
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
        $(DetailsWrapper).addClass('field-hidden');
        $(TicketWrapper).removeClass('field-hidden');
    }
    
    function hideTicketStep() {
        $(TicketWrapper).addClass('field-hidden');
    }
});