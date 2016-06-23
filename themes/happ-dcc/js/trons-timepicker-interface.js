/**
 * Created by Heath on 23/06/16.
 */
$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 1,
    minTime: '0',
    maxTime: '11:59pm',
    defaultTime: false,
    startTime: false,
    dynamic: false,
    dropdown: false,
    scrollbar: true
});

$('.timepicker-dropdown').timepicker({
    timeFormat: 'h:mm p',
    interval: 1,
    minTime: '0',
    maxTime: '11:59pm',
    defaultTime: '11',
    startTime: '7:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});