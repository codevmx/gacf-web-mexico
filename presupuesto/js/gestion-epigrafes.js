$(document).ready(function () {

    $("#inputCuenta").select2({
        dropdownParent: $('#modalAgregarEpigrafe'),
        language: {

            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando..";
            }
        }
    });
    //ConsultaEpigrafes();
    //$('#inputCuenta').select2();

    $('#eliminarEPGF').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal 
        var id = button.data('id');

        var modal = $(this)
        modal.find('.modal-title').text('Eliminar Registro');
        modal.find('.modal-body #keyepig').val(id);
    });

    $("#BtnConfiElim").click(function () {
        EliminarEpigrafes();
    });

    $("#BtnConfiCrear").click(function () {
        var vacios          = 0;
        $("#formCrearepig input").each(function () {
            var valor = $(this).val();
            if (valor == '') {
                $("#" + this.id).addClass("bordeRojoValidacion");
                vacios++;
            }else{
                $("#" + this.id).removeClass("bordeRojoValidacion");
            }
        });
        $("#formCrearepig select").each(function () {
            var valor = $(this).val();
            if (valor == '') {
                $("#" + this.id).addClass("bordeRojoValidacion");
                vacios++;
            }else{
                $("#" + this.id).removeClass("bordeRojoValidacion");
            }
        });
        if (vacios>0) {
            FnNotificacion('Complete los datos', 'error');
        }else{
            CrearEpigrafes();
        }
        
    });

});

function EliminarEpigrafes() {
    var accion = 'eliminar';
    $.ajax({
        data: $("#formElimepig").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/pgm/gestionEpigrafes_pgm.php?accion=" + accion,

        success: function (data1) {
            var json1 = eval("(" + data1 + ")");
            msj = json1.msj;
            alerta = json1.alerta;
            $('#eliminarEPGF').modal('toggle');
            FnNotificacion(msj, alerta);
            $("#datatables-gestionEpigrafes").DataTable().ajax.reload();

            // $("#DivMsj").empty('');
            // $("#DivMsj").append(msj1);
            

        }

    });
}


function CrearEpigrafes() {
    var accion = 'crear';
    $.ajax({
        data: $("#formCrearepig").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/pgm/gestionEpigrafes_pgm.php?accion=" + accion,

        success: function (data2) {
            var json2 = eval("(" + data2 + ")");
            msj = json2.msj;
            alerta = json2.alerta;
            $('#modalAgregarEpigrafe').modal('toggle');
            FnNotificacion(msj, alerta);
            $('#formCrearepig')[0].reset();
            $('#inputCuenta').val(null).trigger('change');

        }

    });
}