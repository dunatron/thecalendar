/**
 * Created by admin on 17/02/17.
 */
var FilterTagsHolder = $('.RealTagsHolder'),
    FilterModal = $('#FilterModal');

$(FilterModal).modal({
    backdrop: false,
    show:false
});

$(FilterTagsHolder).select2();
