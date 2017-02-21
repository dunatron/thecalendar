/**
 * Created by admin on 17/02/17.
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
    console.log(currentTagArray);
    applyFilter();
    $(this).addClass('Filter-Selected')
});

$(FilterTagsHolder).on('select2:unselect', function(){
    currentTags();
    console.log(currentTagArray);
});

$(FilterTagsHolder).on('select2:open', function(){
    $(this).addClass('picking-filter-tags');
});

$(FilterTagsHolder).on('select2:closing', function(){
    $(this).removeClass('picking-filter-tags');
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
    console.log(currentTagArray);
    $('.event-btn').each(function(){

        var eventTags = $(this).attr('data-tag');

        if($.inArray(eventTags, currentTagArray) !== -1){
            console.log('WE have found ONE');
            $(this).removeClass('hide-event');
            $(this).addClass('show-event');
        } else {
            console.log('Not found');
            $(this).addClass('hide-event');
            $(this).removeClass('show-event');
        }
    });

}