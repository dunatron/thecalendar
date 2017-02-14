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
        LocationNext    =   $('#locationNext'),
        DateWrapper =   $('#date-step'),
        DateBack    =   $('#dateBack'),
        SubmitBtn   =   $('#submitHappEvent'),
        addEventModal = $('#AddHappEventModal'),
        continueAddEventOverlay = $('.continue-add-event-overlay'),
        clearFormBtn    = $('#Form_HappEventForm_action_ClearAction'),
        resetFormBtn    = $('#reset-add-event'),
        continueFormBtn = $('#continue-add-event');



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

    $(LocationNext).on('click', function(){
        hideLocationStep();
        showDateStep();
        showSubmitBtn();
    });

    $(DateBack).on('click', function(){
        hideSubmitBtn();
        hideDateStep();
        showLocationStep();
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
        showMap();
    }

    function hideLocationStep() {
        $(LocationWrapper).addClass('field-hidden');
    }

    function showDateStep() {
        $(DateWrapper).removeClass('field-hidden');
    }

    function hideDateStep(){
        $(DateWrapper).addClass('field-hidden');
    }

    function hideSubmitBtn() {
        $(SubmitBtn).addClass('field-hidden');
    }

    function showSubmitBtn() {
        $(SubmitBtn).removeClass('field-hidden');
    }


    function showMap() {
        $('#addEventMap').locationpicker('autosize');
    }

    // Continue overlay functions
    function hideContinueOverlay(){
        $(continueAddEventOverlay).addClass('hide-continue-options');
        $(continueAddEventOverlay).removeClass('show-continue-options');
    }

    function showContinueOverlay() {
        $(continueAddEventOverlay).addClass('show-continue-options');
        $(continueAddEventOverlay).removeClass('hide-continue-options');
    }

    // wipe/reset form
    $(resetFormBtn).on('click', function(){
        resetAddEventForm();
    });
    //Continue form where user left off
    $(continueFormBtn).on('click', function(){
        resumeAddEventForm();
    });

    function resumeAddEventForm(){
        hideContinueOverlay();
    }

    function resetAddEventForm()
    {
        $(clearFormBtn).trigger('click');
        hideSubmitBtn();
        hideDateStep();
        hideLocationStep();
        hideTicketWebsiteStep();
        showDetailsStep();
        hideContinueOverlay();
    }



    // //Details Tags step
    // $('.checkbox').on('click', function(){
    //     $(this).parent().toggleClass('tag-selected');
    // });
    //Details Tags step
    $("input[name*='EventTags']").on('click', function(){
        $(this).parent().toggleClass('tag-selected');
    });

    // If details step has tickets

    $("input[name*='HasTickets']").on('click', function(){
        $(this).parent().toggleClass('tag-selected');
    });

    $(addEventModal).on('shown.bs.modal', function () {
        $('#eventMap1').locationpicker('autosize');
        $('html').addClass('modal-open');
    });

    $(addEventModal).on('hidden.bs.modal', function () {
        $('html').removeClass('modal-open');
        showContinueOverlay();
    });

});