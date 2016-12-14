/**
 * Created by admin on 14/12/16.
 */
$(document).ready(function () {

    var DetailsNext = $('#detailsNextBtn'),
        TicketCheck = $('#hasTickets'),
        DetailsWrapper = $('#details-step'),
        TicketWrapper = $('#ticket-step'),
        TicketBackBtn = $('#ticketBackBtn'),
        TicketNextBtn = $('#ticketNextBtn'),
        AccessField = $('#Form_HappEventForm_AccessType_5'),
        TicketWebWrapper = $('#ticket-web-step'),
        TicketWebBackBtn = $('#ticketWebBack'),
        TicketWebNextBtn = $('#ticketWebNext'),
        LocationWrapper = $('#location-step'),
        LocationBack    =   $('#locationBack'),
        LocationNext    =   $('#locationNext');



    $(DetailsNext).on('click', function () {
        if ($(TicketCheck).is(':checked')) {
            showTicketStep();
            hideDetailsStep();
        } else {
            hideDetailsStep();
            showLocationStep();
        }
    });

    $(TicketBackBtn).on('click', function () {
        hideTicketStep();
        showDetailsStep();
    });

    $(TicketNextBtn).on('click', function(){
        if ($(AccessField).is(':checked')){
            hideTicketStep();
            showTicketWebsiteStep();
        } else {
            hideTicketStep();
            showLocationStep();
        }
    });

    $(TicketWebBackBtn).on('click', function(){
        hideTicketWebsiteStep();
        showTicketStep();
    });

    $(TicketWebNextBtn).on('click', function(){
        hideTicketWebsiteStep();
        showLocationStep();
    });

    $(LocationBack).on('click', function(){
        if ($(AccessField).is(':checked')){
            hideLocationStep();
            showTicketWebsiteStep();
        } else if($(TicketCheck).is(':checked')) {
            hideLocationStep();
            showTicketStep();
        } else {
            hideLocationStep();
            showDetailsStep();
        }
    });

    function showDetailsStep() {
        $(DetailsWrapper).removeClass('field-hidden');
    }

    function hideDetailsStep() {
        $(DetailsWrapper).addClass('field-hidden');
    }

    function showTicketStep() {
        $(TicketWrapper).removeClass('field-hidden');
    }

    function hideTicketStep() {
        $(TicketWrapper).addClass('field-hidden');
    }

    function showTicketWebsiteStep() {
        $(TicketWebWrapper).removeClass('field-hidden');
    }

    function hideTicketWebsiteStep() {
        $(TicketWebWrapper).addClass('field-hidden');
    }

    function showLocationStep() {
        $(LocationWrapper).removeClass('field-hidden');
    }

    function hideLocationStep() {
        $(LocationWrapper).addClass('field-hidden');
    }
});