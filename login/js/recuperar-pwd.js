$(document).ready(function () {

    $("#btn-restore").append('<i class="bi bi-send-check" id="icon-send"></i>');
    $("#btn-restore").click(FnRestore);

});

function FnRestore(){
    $.ajax({
        data: $("#restoreForm").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/login/pgm/restore-pwd-pgm.php",
        beforeSend: function() {
            FnLoadLogin();
        },
        success: function(data) {
            var json = eval("(" + data + ")");
            band     = json.band;
            msj      = json.msj;
            alert    = json.alert;

            if (band == '1') {
                FnNotificacion(msj,alert);	
                $("#btn-restore").text("Redireccionando...");
                setTimeout(function() {
                    window.location.href = "gacf";
                }, 3000);

                $('#signupForm').trigger("reset");     
            }else if (band == '3') {
                //Error con username
                FnNotificacion(msj,alert);
                FnUploadLogin();
            }
        
        }
    });

    return false;
}

function FnLoadLogin(){
    $("#icon-send").remove();
    $("#btn-restore").addClass("disabled");
    $("#btn-restore").append('<span class="spinner-border spinner-border-sm me-1" id="spinner-load" role="status" aria-hidden="false"></span>');
}

function FnUploadLogin(){
    $("#spinner-load").remove();
    $("#btn-restore").removeClass("disabled");
    $("#btn-restore").append('<i class="bi bi-send-check" id="icon-send"></i>');
}