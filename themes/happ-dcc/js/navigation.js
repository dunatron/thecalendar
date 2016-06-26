/**
 * Created by Heath on 24/05/16.
 */
var xmlHttp = createXmlHttpRequestObject();
/**
 *
 *This object is the core of ajax, communicates with server and user computer
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
 * OnClick Previous Month
 */
$('#previous-month').on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    // Replace calendar body
    $.ajax(url + "/jaxPreviousMonth")
        .done(function (response) {
            $('.fc-calendar-container').html(response);
        })
        .fail(function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
    // Replace Month Name
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
    $.ajax(url + "/BMonthName")
        .done(function (response) {
            $('.short-next-text').html(response);
        })
        .fail(function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
    // Replace Previous button short month
    $.ajax(url + "/FMonthName")
        .done(function (response) {
            $('.short-previous-text').html(response);
        })
        .fail(function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
});

/**
 * OnClick Next Month
 */

$('.calendarpage').on('click', '#next-month', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    // Replace calendar body
    $.ajax(url + "/jaxNextMonth")
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
 * OnClick Next Month
 */

// $('#next-month').on('click', function (e) {
//     e.preventDefault();
//     var url = $(this).attr('href');
//     $('.fc-calendar-container').load(url + '/jaxNextMonth');
//     $('.short-next-text').load(url + '/nextShortMonth');
//     $('.short-previous-text').load(url + '/prevShortMonth');
//     $('.theMonth').load(url + '/nextShortMonth');
//     $('.theYear').load(url + '/currentYear');
// });


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


//window.onload = function() {
//    // prep anything we need to
//    prepareEventHandlers();
//}




