$(document).ready(function () {

    $.ajax({
        url: '/system/events/import/ticketsolve',
        method: 'GET',
        success: function (result) {
            $('#import-events').html(result);
        }
    });

});