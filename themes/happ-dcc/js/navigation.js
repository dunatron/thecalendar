/**
 * Created by Heath on 24/05/16.
 */


//$("document").ready(function() {
//    $("#previous-month").click(function() {
//        console.log('heath');
////        $("#content").load("CalendarPage/prevMonth");
//        $.ajax("CalendarPage/prevMonth", function(data) {
//            alert(data);
//        });
//    });
//});


//
//$('.main').on('click','.pagination a', function (e) {
//    e.preventDefault();
//    var url = $(this).attr('href');
//    $.ajax(url)
//        .done(function (response) {
//            $('.main').html(response);
//        })
//        .fail (function (xhr) {
//        alert('Error: ' + xhr.responseText);
//    });
//});

//$('.fc-calendar').on('click','.pagination a', function (e) {
//    e.preventDefault();
//    var url = $(this).attr('href');
//    $.ajax(url)
//        .done(function (response) {
//            $('.main').html(response);
//        })
//        .fail (function (xhr) {
//        alert('Error: ' + xhr.responseText);
//    });
//});



//$("document").ready(function() {
//    $("#previous-month").click(function() {
//        console.log('heath');
////        $("#content").load("CalendarPage/prevMonth");
//        $.ajax("CalendarPage/prevMonth", function(data) {
//            alert(data);
//        });
//    });
//});

//document.onclick = function() {
//    alert("you clicked somewhere in the document");
//}


$('.calendarpage').on('click','#previous-month', function (e) {
    e.preventDefault();
//    alert("Lol you want to view last months events? why?");
    var url = $(this).attr('href');
    $.ajax(url)
        .done(function (response) {
            $('.fc-calendar-container').html(response);
        })
        .fail (function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
});


//function prepareEventHandlers() {
//
//    var previousMonth = document.getElementById("previous-month");
//
//    previousMonth.onclick = function() {
//        alert("Lol you want to view last months events? why?");
//    }
//}

window.onload = function() {
    // prep anything we need to
    prepareEventHandlers();
}

//Simple Ajax example

// 1: Create the request
var myRequest;

// feature check
if (window.XMLHttpRequest) { // does it exist? we're in Firefox, Safari etc.
    myRequest = new XMLHttpRequest();
} else if (window.ActiveXObject) { //if not we're in IE
    myRequest = new ActiveXObject("Microsoft.XMLHTTP");
}

// 2: create an event handler for our request to call back
myRequest.onreadystatechange = function() {
    console.log("we were called!");
}

// open and send it
myRequest.open('GET', 'simple.txt', true);
// any parameters?
myRequest.send(null);
