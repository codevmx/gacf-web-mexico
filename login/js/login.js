$(document).ready(function () {

    $("#btn-signin").append('<i class="bi bi-arrow-right-circle" id="icon-circle"></i>');
    $("#btn-signin").click(FnLogin);

});

function FnLogin(){
    $.ajax({
        data: $("#signupForm").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/login/pgm/login-pgm.php",
        beforeSend: function() {
            $("#icon-circle").remove();
            $("#btn-signin").addClass("disabled");
            $("#btn-signin").append('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="false"></span>');
        },
        success: function(data) {

            var json = eval("(" + data + ")");
            band     = json.band;
            msj      = json.msj;
            alert    = json.alert;
            //perfil   = json.perfil;

            if (band == '4') {					
                //Error por permisos
                FnNotificacion(msj,alert);	
            } else if (band == '3') {
                //Error con username
                FnNotificacion(msj,alert);	
            } else if (band == '2') {
                // Error Password
                FnNotificacion(msj,alert);	
            } else if (band == '1') {
                FnNotificacion(msj,alert);	
                window.location.href = "gacf-dashboard";
                $('#signupForm').trigger("reset");                

            }

        }

    });

    return false;
}