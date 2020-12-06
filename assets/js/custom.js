$(document).ready(function() {
    let alert = $('.alert');

    if (alert.is(':visible')) {
        setTimeout(function(){ alert.css("display", "none"); }, 2500);
    }

    $('#logout').click(function(e) {
        e.preventDefault();
        $('#logout-form').submit();
    })

    $('#delete-task').click(function(e) {
        e.preventDefault();
        $('#delete-form').submit();
    })


    $('#sort').on('change', function(e){
        e.preventDefault();
        $(this).closest('form').submit();
    });
})