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

    var filterTAGS = [];
    var filterValues = [];

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
        $tagTitle = $(this).attr("data-title");
        $tagID = $(this).attr("data-tag");
        // if(jQuery.inArray($tagTitle, filterTAGS) ==1) {
        //     console.log('ITS VERY TRUE');
        // }
        if($.inArray(filterTAGS, $tagTitle)) {
            filterValues.push($tagID);
            console.log("SURELY");
        }

        console.log($tagTitle);
    });

    console.log(filterTAGS);
    console.log(filterValues);

});

//select2-selection__choice