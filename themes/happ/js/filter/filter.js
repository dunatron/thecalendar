/**
 * Created by admin on 17/02/17.
 */
var FilterTagsHolder = $('.RealTagsHolder'),
    FilterModal = $('#FilterModal'),
    currentTagArray = [],
    event = $('.event-btn');

$(FilterModal).modal({
    backdrop: false,
    show:false
});

$(FilterTagsHolder).select2({
    placeholder: "Filter..."
});

$(FilterTagsHolder).on('select2:select', function(){
    currentTags();
    console.log(currentTagArray);
    applyFilter();
});

$(FilterTagsHolder).on('select2:unselect', function(){
    currentTags();
    console.log(currentTagArray);
});

function currentTags(){
    var TagData = $(FilterTagsHolder).select2('data');
    currentTagArray = [];
    $.each(TagData, function( key, value ){
        currentTagArray.push(value.text);
    });
}

function applyFilter(){
    // $.each(event, function(index, value){
    //     console.log('div' + index + ':' + $(this).attr('eid'));
    // });
    var myCount=0;
    $('.event-btn').each(function(){
       //console.log($(this).attr('data-tag'));
        var eventTags = $(this).attr('data-tag');
        // seperate eventTags string by delimeter | then do array loop
        if(!$.inArray(eventTags, currentTagArray)){
            console.log('WE have found ONE');
            $(this).removeClass('hide-event');
            $(this).addClass('show-event');
        } else {
            $(this).addClass('hide-event');
            $(this).removeClass('show-event');
        }
        //console.log(eventTags + myCount++);

    });

}


// var array = string.split('|');


