/**
 * Created by Heath on 24/08/15.
 */

$(function() {

    var cal = $( '#calendar' ).calendario( {
            onDayClick : function( $el, $contentEl, dateProperties ) {

               //for( var key in dateProperties ) {
               //     console.log( key + ' = ' + dateProperties[ key ] );
               //     window.alert(key + ' = ' + dateProperties[ key ] );
               // }
                //tronFunction();
                cal.getCell();

            },
            caldata : null

        } ),
        $month = $( '#custom-month' ).html( cal.getMonthName() ),
        $year = $( '#custom-year' ).html( cal.getYear() );

    $( '#custom-next' ).on( 'click', function() {
        cal.gotoNextMonth( updateMonthYear );
    } );
    $( '#custom-prev' ).on( 'click', function() {
        cal.gotoPreviousMonth( updateMonthYear );
    } );
    $( '#custom-current' ).on( 'click', function() {
        cal.gotoNow( updateMonthYear );
    } );

    function updateMonthYear() {
        $month.html( cal.getMonthName() );
        $year.html( cal.getYear() );
    }

    cal.setData( {
        '03-01-2015' : '<a href="#">testing</a><a href="#">testing two events</a>',
        '03-10-2015' : '<a href="#">testing</a><a href="#">testing two events</a><a href="#">testing two events</a><a href="#">testing two events</a>' +
            '<a href="#">testing two events</a><a href="#">testing two events</a><a href="#">testing two events</a>',
        '04-27-2016' : '<a href="#" class="btn btn-info" role="button">Link Button</a>'
    } );

    // you can also add more data later on. As an example:
    /*
     someElement.on( 'click', function() {

     cal.setData( {
     '03-01-2013' : '<a href="#">testing</a>',
     '03-10-2013' : '<a href="#">testing</a>',
     '03-12-2013' : '<a href="#">testing</a>'
     } );
     // goes to a specific month/year
     cal.goto( 3, 2013, updateMonthYear );

     } );


     */

    // just an example..
    function tronFunction() {
        cal.goto( 2, 2015, updateMonthYear );
        /*
        Will Load in an overlay which will display the events on for that specific day.

         */

    }




});