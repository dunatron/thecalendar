/**
 * Created by Heath on 22/04/16.
 */
/*
 Author: Dunatron
 Date: Thursday 21st April 2016
 ****************************
 About: There has been a lot of debate about the scroll bar and if you have ever tried to hide
 it and still be able to scroll, you will realsise there is no easy answer, especially in my case which is why
 I am developing this. Seriously stack overflows solution is to cover it up with another div...

 This will hide scroll your content without a sidebar, so turn your overflows to hidden and use this plugin
 =)
 A slight configuration at the bottom is all that is needed
 *****************************
 Many thanks to http://brandonaaron.net for your useful code
 *****************************
 */


(function(c){var a=["DOMMouseScroll","mousewheel"];c.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var d=a.length;d;){this.addEventListener(a[--d],b,false)}}else{this.onmousewheel=b}},teardown:function(){if(this.removeEventListener){for(var d=a.length;d;){this.removeEventListener(a[--d],b,false)}}else{this.onmousewheel=null}}};c.fn.extend({mousewheel:function(d){return d?this.bind("mousewheel",d):this.trigger("mousewheel")},unmousewheel:function(d){return this.unbind("mousewheel",d)}});function b(f){var d=[].slice.call(arguments,1),g=0,e=true;f=c.event.fix(f||window.event);f.type="mousewheel";if(f.wheelDelta){g=f.wheelDelta/120}if(f.detail){g=-f.detail/3}d.unshift(f,g);return c.event.handle.apply(this,d)}})(jQuery);

/*
 Configure the below code to whatever div you want to scroll
 */
$(".day-square").bind("mousewheel",function(ev, delta) {
    var scrollTop = $(this).scrollTop();
    $(this).scrollTop(scrollTop-Math.round(delta * 20));
});

$(".modal-body").bind("mousewheel",function(ev, delta) {
    var scrollTop = $(this).scrollTop();
    $(this).scrollTop(scrollTop-Math.round(delta * 20));
});

$(".calendarpage").bind("mousewheel",function(ev, delta) {
    var scrollTop = $(this).scrollTop();
    $(this).scrollTop(scrollTop-Math.round(delta * 20));
});
