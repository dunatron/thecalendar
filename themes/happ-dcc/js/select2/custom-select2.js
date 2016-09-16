/**
 * Created by Heath on 12/09/16.
 */
var tagsDropdown = $('#tag-drop-down').select2({
    tags:true
});

/**
 * When A tag(filter) has been selected do stuff
 * 1. get children of selection (select2-selection__rendered)
 *
 *  selecting a TAG
 *
 */


tagsDropdown.on("select2:select", function (e) {
   console.log("A tag was selected");

    var filterTAGS = []; // All tags from the calendar
    var filterValues = []; // selected filter tags

    //select2-selection__rendered
    var tagsHolder = $('.select2-selection__rendered');
    var realatedList = $('.RealTagsHolder');

    function getFilterTags() {
        var tags = tagsHolder.children().each(function () {
            var tagTitle = $(this).attr("title");
            filterTAGS.push(tagTitle);
        });
    }

    getFilterTags();

    var relatedTagIDS = realatedList.children().each(function () {
        var tagTitle = $(this).attr("data-title");
        var tagID = $(this).attr("data-tag");
        if(jQuery.inArray(tagTitle, filterTAGS)!='-1') {
            console.log("IN THE ARRAY");
            filterValues.push(tagID);
        } else {
            console.log("NOT IN ARRAY");
        }
    });


    function filterEvents(){

        console.log("TIME TO FILTER EVENTS");
        console.log("TIME TO FILTER EVENTS AND VALUES " + filterValues);

        var events = $('.event-btn');
        jQuery.each(events, function () {
            console.log("COUNT THE EVENTS");
            var eventTags = $(this).attr("data-tag");
            console.log("COUNT THE EVENTS and the tag " + eventTags);
            // compare if event tag ID is present in the filterTAGS list
            if(jQuery.inArray(eventTags, filterValues)!='-1') {
                console.log("SHOW EVENTS");
                // append show event OR AND remove hide-event class
                $(this).removeClass('hide-event');

            } else {
                console.log("NOT IN ARRAY");
                $(this).addClass('hide-event');
            }
        });
    }

    filterEvents();

});


/**
 *
 *  un-selecting a TAG
 */

// when this is clicked '.select2-selection__choice__remove'
// check what tags are still up

tagsDropdown.on("select2:unselect", function (e) {
    console.log("A tag was selected");

    var filterTAGS = []; // All tags from the calendar
    var filterValues = []; // selected filter tags

    //select2-selection__rendered
    var tagsHolder = $('.select2-selection__rendered');
    var realatedList = $('.RealTagsHolder');

    function getFilterTags() {
        var tags = tagsHolder.children().each(function () {
            var tagTitle = $(this).attr("title");
            filterTAGS.push(tagTitle);
        });
    }

    getFilterTags();

    var relatedTagIDS = realatedList.children().each(function () {
        var tagTitle = $(this).attr("data-title");
        var tagID = $(this).attr("data-tag");
        if(jQuery.inArray(tagTitle, filterTAGS)!='-1') {
            console.log("IN THE ARRAY");
            filterValues.push(tagID);
        } else {
            console.log("NOT IN ARRAY");
        }
    });


    function filterEvents(){

        console.log("TIME TO FILTER EVENTS");
        console.log("TIME TO FILTER EVENTS AND VALUES " + filterValues);

        var events = $('.event-btn');
        jQuery.each(events, function () {
            console.log("COUNT THE EVENTS");
            var eventTags = $(this).attr("data-tag");
            console.log("COUNT THE EVENTS and the tag " + eventTags);
            // compare if event tag ID is present in the filterTAGS list
            if(jQuery.inArray(eventTags, filterValues)!='-1') {
                console.log("SHOW EVENTS");
                // append show event OR AND remove hide-event class
                $(this).removeClass('hide-event');

            } else {
                console.log("NOT IN ARRAY");
                $(this).addClass('hide-event');
            }
        });
    }

    filterEvents();

    if (filterValues.length == 0){
        var events = $('.event-btn');
        jQuery.each(events, function () {
            events.removeClass('hide-event');
            //alert(events);
        });
        // alert("time to show all the events again cgump");
    }

    console.log('array size' + filterValues.length);


});


//select2-selection__choice