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
            FnLoadLogin();
        },
        success: function(data) {

            var json = eval("(" + data + ")");
            band     = json.band;
            msj      = json.msj;
            alert    = json.alert;

            if (band == '4') {					
                //Error por permisos
                FnNotificacion(msj,alert);	
                $("#btn-signin").text("Redireccionando...");
                setTimeout(function() {
                    window.location.href = "gacf-actualizar-pwd";
                }, 3000);

                $('#signupForm').trigger("reset");   

            } else if (band == '3') {
                //Error con username
                FnNotificacion(msj,alert);
                FnUploadLogin()
            } else if (band == '2') {
                // Error Password
                FnNotificacion(msj,alert);	
                FnUploadLogin()
            } else if (band == '1') {
                FnNotificacion(msj,alert);	
                $("#btn-signin").text("Inicializando perfil...");
                setTimeout(function() {
                    window.location.href = "gacf-dashboard";
                }, 3000);

                $('#signupForm').trigger("reset");                

            }                      	

        }

    });

    return false;
}

function FnLoadLogin(){
    $("#icon-circle").remove();
    $("#btn-signin").addClass("disabled");
    $("#btn-signin").append('<span class="spinner-border spinner-border-sm me-1" id="spinner-load" role="status" aria-hidden="false"></span>');
}

function FnUploadLogin(){
    $("#spinner-load").remove();
    $("#btn-signin").removeClass("disabled");
    $("#btn-signin").append('<i class="bi bi-arrow-right-circle" id="icon-circle"></i>');
}