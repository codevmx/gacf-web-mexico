$(document).ready(function () {
    $("#btn-signin").append('<i class="bi bi-arrow-right-circle" id="icon-circle"></i>');

    $('#btn-signin').click(function () {
        $("#icon-circle").remove();
        $("#btn-signin").addClass("disabled");
        $("#btn-signin").append('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="false"></span>');
    });

});