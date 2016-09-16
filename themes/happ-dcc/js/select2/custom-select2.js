/**
 * Created by Heath on 12/09/16.
 */
var tagsDropdown = $('#tag-drop-down').select2({
    tags:true
});

/**
 * When A tag(filter) has been selected do stuff
 * 1. get children of selection (select2-selection__rendered)
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

    console.log('filter tags' + filterTAGS);
    console.log('filter values' + filterValues);

});

//select2-selection__choice