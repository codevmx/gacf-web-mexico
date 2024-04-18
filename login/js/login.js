$(document).ready(function () {

    $("#btn-signin").append('<i class="bi bi-arrow-right-circle" id="icon-circle"></i>');
    $("#btn-signin").click(FnLogin);

});

function FnLogin(){
    $.ajax({
        data: $("#signupForm").serialize(),
        type: "POST",
        dataType: "html",
        url: "../pgm/login-pgm.php",
        beforeSend: function() {
            $("#icon-circle").remove();
            $("#btn-signin").addClass("disabled");
            $("#btn-signin").append('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="false"></span>');
        },
        success: function(data) {

            var json = eval("(" + data + ")");
            msj      = json.msj;
            perfil   = json.perfil;

            if (msj == '4') {					
                //Error por permisos
                $("#resultado").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> &nbsp;El usuario ingresado no tiene permisos de acceso, verifíquelo con su administrador.</div>');
            } else if (msj == '3') {					
                //Error con username
                $("#resultado").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> &nbsp;El usuario ingresado no existe.</div>');
            } else if (msj == '2') {
                // Error Password
                $("#resultado").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> &nbsp;El usuario y/o la contraseña ingresados no coinciden.</div>');
            } else if (msj == '1') {
                $("#resultado").html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Redireccionando!</strong> &nbsp;El usuario y la contraseña son correctos.</div>');
                window.location.href = "gacf-dashboard";
                $('#signupForm').trigger("reset");                

            }

        }

    });

    return false;
}