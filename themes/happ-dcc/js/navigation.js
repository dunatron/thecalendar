/**
 * Created by Heath on 24/05/16.
 */
var xmlHttp = createXmlHttpRequestObject();
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
 * Reset Calendar Dates
 */
$('#reset-calendar-dates').on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-target');
    // Replace calendar body
    $.ajax(url + "/resetCalendarDate")
        .done(function (response) {
            $('.fc-calendar-container').html(response);
        })
        .fail(function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
    // Replace Month
    $.ajax(url + "/currentMonthName")
        .done(function (response) {
            $('.theMonth').html(response);
        })
        .fail(function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
    // Replace Year
    $.ajax(url + "/currentYear")
        .done(function (response) {
            $('.theYear').html(response);
        })
        .fail(function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
    // Replace Next button short month
   $.ajax(url + "/nextShortMonth")
       .done(function (response) {
           $('.short-next-text').html(response);
       })
       .fail(function (xhr) {
       alert('Error: ' + xhr.responseText);
   });
   // Replace Previous button short month
   $.ajax(url + "/prevShortMonth")
       .done(function (response) {
           $('.short-previous-text').html(response);
       })
       .fail(function (xhr) {
       alert('Error: ' + xhr.responseText);
   });
});

/**
 * Next Month Logic
 */
$('.calendarpage').on('click', '#next-month', function (e) {
    var requestCallback = new MyRequestsCompleted({
        numRequest: 5
    });
    var url = $(this).attr('href');
    $.ajax({
        url: url + '/jaxNextMonth',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.fc-calendar-container').html(response);
                alert('Im the first callback');
            });
        }
    });
    $.ajax({
        url: url + '/currentMonthName',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.theMonth').html(response);
                alert('Im the second callback');
            });
        }
    });
    $.ajax({
        url: url + '/currentYear',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.theYear').html(response);
                alert('Im the second callback');
            });
        }
    });
    $.ajax({
        url: url + '/nextShortMonth',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.short-next-text').html(response);
                alert('Im the second callback');
            });
        }
    });
    $.ajax({
        url: url + '/prevShortMonth',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.short-previous-text').html(response);
                alert('Im the second callback');
            });
        }
    });
});

/**
 * Previous Month Logic
 */
$('.calendarpage').on('click', '#previous-month', function (e) {
    var requestCallback = new MyRequestsCompleted({
        numRequest: 5
    });
    var url = $(this).attr('href');
    $.ajax({
        url: url + '/jaxPreviousMonth',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.fc-calendar-container').html(response);
                alert('Im the first callback');
            });
        }
    });
    $.ajax({
        url: url + '/currentMonthName',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.theMonth').html(response);
                alert('Im the second callback');
            });
        }
    });
    $.ajax({
        url: url + '/currentYear',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.theYear').html(response);
                alert('Im the second callback');
            });
        }
    });
    $.ajax({
        url: url + '/nextShortMonth',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.short-next-text').html(response);
                alert('Im the second callback');
            });
        }
    });
    $.ajax({
        url: url + '/prevShortMonth',
        success: function(data) {
            requestCallback.addCallbackToQueue(true, function() {
                $('.short-previous-text').html(response);
                alert('Im the second callback');
            });
        }
    });
});


var MyRequestsCompleted = (function() {
    var numRequestToComplete,
        requestsCompleted,
        callBacks,
        singleCallBack;

    return function(options) {
        if (!options) options = {};

        numRequestToComplete = options.numRequest || 0;
        requestsCompleted = options.requestsCompleted || 0;
        callBacks = [];
        var fireCallbacks = function () {
            // alert("we're all complete");
            for (var i = 0; i < callBacks.length; i++) callBacks[i]();
        };
        if (options.singleCallback) callBacks.push(options.singleCallback);



        this.addCallbackToQueue = function(isComplete, callback) {
            if (isComplete) requestsCompleted++;
            if (callback) callBacks.push(callback);
            if (requestsCompleted == numRequestToComplete) fireCallbacks();
        };
        this.requestComplete = function(isComplete) {
            if (isComplete) requestsCompleted++;
            if (requestsCompleted == numRequestToComplete) fireCallbacks();
        };
        this.setCallback = function(callback) {
            callBacks.push(callBack);
        };
    };
})();





