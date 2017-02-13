/**
 * Created by Heath on 21/06/16.
 */
function setDimensions()
{
    var windowsHeight = $(window).height();
    $('.modal-body').css('height', windowsHeight -300);
}

// when resizing we adjust the height of the form
$(window).resize(function(){
    setDimensions();
});