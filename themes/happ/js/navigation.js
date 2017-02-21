/**
 * Created by Heath on 24/05/16.
 */
$(document).ready(function () {
    var xmlHttp = createXmlHttpRequestObject(),
        ajaxPageLoad = $('.ajax-page-load'),
        searchModal = $('#SearchModal'),
        happSearchBtn = $('#searchHappEvents');

    /**
     *
     * This object is the core of ajax, communicates with server and user computer
     * DO NOT REMOVE AJAX OBJECT
     *
     **/
    function createXmlHttpRequestObject() {
        var xmlHttp;

        // If a window is open in your browser is aware of this object
        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        } else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");//you are IE
        }

        return xmlHttp;// this object is now usable by other functions
    }

    /**
     *
     * Handle the first thing that is loaded when we visit the page
     *
     **/
    function process() {
        if (xmlHttp) {
            try {
                xmlHttp.open("GET", "bacon.txt", true); //Configure connection settings with server
                xmlHttp.onreadystatechange = handleServerResponse;
                xmlHttp.send(null); //this connects with the server
            } catch (e) {
                alert(e.toString());
            }
        }
    }

    /**
     *
     * Handle server response
     *
     **/
    function handleServerResponse() {
        theD = document.getElementById('theD');
        if (xmlHttp.readyState == 1) {
            theD.innerHTML += "status 1: server connection established <br />";
        } else if (xmlHttp.readyState == 2) {
            theD.innerHTML += "status 2: request received <br />";
        } else if (xmlHttp.readyState == 3) {
            theD.innerHTML += "status 3: request received <br />";
        } else if (xmlHttp.readyState == 4) {
            if (xmlHttp.status == 200) {
                try {

                    text = xmlHttp.responseText;
                    theD.innerHTML += "Status 4: request is finished and response is ready <br/>";
                    theD.innerHTML += text;
                } catch (e) {
                    alert(e.toString());
                }
            } else {
                alert(xmlHttp.statusText);
            }
        }
    }

    /**
     * Happ Search
     */
    $(happSearchBtn).on('click', function(e){
        e.preventDefault();
        ajaxIsLoading();

        var browserurl =   window.location.href,
            url = browserurl +'home',
            Keyword = $('#Form_HappSearchForm_keyword').val();

        //alert(url);
        $.ajax({
            type:"POST",
            url: url + '/searchHappEvents',
            data: {Keyword:Keyword},
            success: function (response) {
                $('.search-results-wrapper').html(response);
                console.log(response);
            },
            complete: function(){
                ajaxFinishedLoading();
            }
        });
    });

    $(searchModal).on('shown.bs.modal', function () {
        $('html').addClass('modal-open');
    });

    $(searchModal).on('hidden.bs.modal', function () {
        $('html').removeClass('modal-open');
    });
    
    /**
     * Reset Calendar Dates
     */
    $('#reset-calendar-dates').on('click', function (e) {
        e.preventDefault();
        ajaxIsLoading();
        var url = $(this).attr('data-target');
        var requestCallback = new MyRequestsCompleted({
            numRequest: 5
        });
        // Replace calendar body
        $.ajax({
            url: url + '/resetCalendarDate',
            async: false,
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.fc-calendar-container').html(data);
                    //alert('Im the first callback');
                });
            }
        });
        $.ajax({
            url: url + '/currentMonthName',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.theMonth').html(data);
                    //alert('Im the second callback');
                });
            }
        });
        $.ajax({
            url: url + '/currentYear',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.theYear').html(data);
                    //alert('Im the second callback');
                });
            }
        });
        $.ajax({
            url: url + '/nextShortMonth',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.short-next-text').html(data);
                    //alert('Im the second callback');
                });
            }
        });
        $.ajax({
            url: url + '/prevShortMonth',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.short-previous-text').html(data);
                    //alert('Im the second callback');
                });
            }
        });
    });

    $('.calendarpage').on('click', '#next-month', function (e) {
        e.preventDefault();
        ajaxIsLoading();

        var url = $(this).attr('href');
        $.ajax({
            type:"POST",
            url: url + '/jaxNextMonth',

            success: function (response) {
                $('.fc-calendar-container').html(response);
                console.log(response);
            },
            complete: function(){
                doMonth();
            }
        });

        function doMonth(){
            $.ajax({
                type:"POST",
                url: url + '/currentMonthName',
                success: function (response) {
                    $('.theMonth').html(response);
                    console.log(response);
                },
                complete: function(){
                    doYear();
                }
            });
        }

        function doYear(){
            $.ajax({
                type:"POST",
                url: url + '/currentYear',
                success: function (response) {
                    $('.theYear').html(response);
                    console.log(response);
                },
                complete: function(){
                    doNextMonth();
                }
            });
        }

        function doNextMonth(){
            $.ajax({
                type:"POST",
                url: url + '/nextShortMonth',
                success: function (response) {
                    $('.short-next-text').html(response);
                    console.log(response);
                },
                complete: function(){
                    doPrevMonth();
                }
            });
        }

        function doPrevMonth(){
            $.ajax({
                type:"POST",
                url: url + '/prevShortMonth',
                success: function (response) {
                    $('.short-previous-text').html(response);
                    console.log(response);
                },
                complete: function(){
                    ajaxFinishedLoading();
                    applyFilter();
                }
            });
        }

    });

    /**
     * Previous Month Logic
     */
    $('.calendarpage').on('click', '#previous-month', function (e) {
        e.preventDefault();
        ajaxIsLoading();
        var requestCallback = new MyRequestsCompleted({
            numRequest: 5
        });
        var url = $(this).attr('href');
        $.ajax({
            url: url + '/jaxPreviousMonth',
            async: false, // Wait for this to finish before running anymore code
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.fc-calendar-container').html(data);
                    //alert('Im the first callback');
                });
            },

        });
        $.ajax({
            url: url + '/currentMonthName',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.theMonth').html(data);
                    //alert('Im the second callback');
                });
            }
        });
        $.ajax({
            url: url + '/currentYear',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.theYear').html(data);
                    //alert('Im the second callback');
                });
            }
        });
        $.ajax({
            url: url + '/nextShortMonth',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.short-next-text').html(data);
                    //alert('Im the second callback');
                });
            }
        });
        $.ajax({
            url: url + '/prevShortMonth',
            success: function (data) {
                requestCallback.addCallbackToQueue(true, function () {
                    $('.short-previous-text').html(data);
                    //alert('Im the second callback');
                });
            }
        });
    });


    var MyRequestsCompleted = (function () {
        var numRequestToComplete,
            requestsCompleted,
            callBacks,
            singleCallBack;

        return function (options) {
            if (!options) options = {};

            numRequestToComplete = options.numRequest || 0;
            requestsCompleted = options.requestsCompleted || 0;
            callBacks = [];
            var fireCallbacks = function () {
                ajaxFinishedLoading();
                applyFilter();
                for (var i = 0; i < callBacks.length; i++) callBacks[i]();
            };
            if (options.singleCallback) callBacks.push(options.singleCallback);


            this.addCallbackToQueue = function (isComplete, callback) {
                if (isComplete) requestsCompleted++;
                if (callback) callBacks.push(callback);
                if (requestsCompleted == numRequestToComplete) fireCallbacks();
            };
            this.requestComplete = function (isComplete) {
                if (isComplete) requestsCompleted++;
                if (requestsCompleted == numRequestToComplete) fireCallbacks();
            };
            this.setCallback = function (callback) {
                callBacks.push(callBack);
            };
        };
    })();


    function ajaxIsLoading() {
        $(ajaxPageLoad).addClass('ajax-is-loading');
        $(ajaxPageLoad).removeClass('ajax-not-loading');
    }

    function ajaxFinishedLoading() {
        $(ajaxPageLoad).addClass('ajax-not-loading');
        $(ajaxPageLoad).removeClass('ajax-is-loading');
    }

    ajaxFinishedLoading();

});
/***
 *
 * FILTER jQuery
 */
var FilterTagsHolder = $('.RealTagsHolder'),
    FilterModal = $('#FilterModal'),
    currentTagArray = [],
    event = $('.event-btn');

$(FilterModal).modal({
    backdrop: false,
    show:false,
    label:false
});

$(FilterTagsHolder).select2({
    placeholder: "Filter..."
});

$(FilterTagsHolder).on('select2:select', function(){
    currentTags();
    //console.log(currentTagArray);
    applyFilter();
    $(this).addClass('Filter-Selected')
});

$(FilterTagsHolder).on('select2:unselect', function(){
    currentTags();
    //console.log(currentTagArray);
    applyFilter();
});

$(FilterTagsHolder).on('select2:open', function(){

});

$(FilterTagsHolder).on('select2:closing', function(){

});

function currentTags(){
    var TagData = $(FilterTagsHolder).select2('data');
    currentTagArray = [];
    $.each(TagData, function( key, value ){
        currentTagArray.push(value.text);
    });
}
function applyFilter(){
    if(currentTagArray.length !== 0){
        $('.event-btn').each(function(){
            var eventItem = this;
            var eventTags = $(this).attr('data-tag');

            if($.inArray(eventTags, currentTagArray) !== -1){
                //console.log('WE have found ONE');
                $(this).removeClass('fully-hide-event');
                $(this).removeClass('hide-event');
                $(this).addClass('show-event');

            } else {
                //console.log('Not found');
                $(this).addClass('hide-event');
                $(this).removeClass('show-event');
                setTimeout(function () {
                    console.log('INTERESTING');
                    $(eventItem).addClass('fully-hide-event');
                }, 1200);
            }
        });
    } else {
        $('.event-btn').each(function(){
            $(this).removeClass('fully-hide-event');
            $(this).removeClass('hide-event');
            $(this).addClass('show-event');
        });
    }
}








