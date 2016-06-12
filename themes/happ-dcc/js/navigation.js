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
    if(window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");//you are IE
    }

    return xmlHttp;// this object is now usable by other functions
}

/**
 *
 * Handle the first thing that is loaded when we visit the page
 *
 **/
function process(){
    if(xmlHttp){
        try{
            xmlHttp.open("GET", "bacon.txt", true); //Configure connection settings with server
            xmlHttp.onreadystatechange = handleServerResponse;
            xmlHttp.send(null); //this connects with the server
        }catch(e){
            alert( e.toString() );

        }
    }
}

/**
 *
 * Handle server response
 *
 **/
function handleServerResponse(){
    theD = document.getElementById('theD');
    if(xmlHttp.readyState==1){
        theD.innerHTML += "status 1: server connection established <br />";
    }else if(xmlHttp.readyState==2){
        theD.innerHTML += "status 2: request received <br />";
    }else if(xmlHttp.readyState==3){
        theD.innerHTML += "status 3: request received <br />";
    }else if(xmlHttp.readyState==4){
        if(xmlHttp.status==200){
            try{

                text = xmlHttp.responseText;
                theD.innerHTML += "Status 4: request is finished and response is ready <br/>";
                theD.innerHTML += text;
            }catch(e){
                alert( e.toString() );
            }
        }else{
            alert( xmlHttp.statusText );
        }
    }
}

//handle clickTron
//function clickPrev(){
//    alert("go to previous month");
//    var url = $(this).attr('href');
//    alert(url);
//    $.ajax(url)
//        .done(function (response) {
//            $('.fc-calendar-container').html(response);
//        })
//        .fail (function (xhr) {
//        alert('Error: ' + xhr.responseText);
//    });
//}
//
//function clickNext(){
//    alert("go to next month");
//    var url = $(this).attr('href');
//    alert(url);
//    $.ajax(url)
//        .done(function (response) {
//            $('.fc-calendar-container').html(response);
//        })
//        .fail (function (xhr) {
//        alert('Error: ' + xhr.responseText);
//    });
//}
//
$('.calendarpage').on('click','#previous-month', function (e) {
    e.preventDefault();
//    alert("Lol you want to view last months events? why?");
    var url = $(this).attr('href');
    alert(url);
    $.ajax(url)
        .done(function (response) {
            $('.fc-calendar-container').html(response);
        })
        .fail (function (xhr) {
        alert('Error: ' + xhr.responseText);
    });
});

$('.calendarpage').on('click','#next-month', function (e) {
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


window.onload = function() {
    // prep anything we need to
    prepareEventHandlers();
}

