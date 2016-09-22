$('#FilterModal').on('hidden.bs.modal', function (e) {
    // do something...
});


$('#FilterModal').on('show.bs.modal', function (e) {
    // do something...
});

$('#FilterModal').on('shown.bs.modal', function (e) {
    // do something...
    $('.modal-backdrop').addClass('filter-modal-backdrop');
});