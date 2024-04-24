$(document).ready(function () {
    //window.tablaimportesppto(1);

    // Funcion para repartir datos de un excel
    $('#celda').on('input', function () {
        // Obtener el valor del campo de entrada
        var valor = $(this).val();
        // var valpptoene  = valor.replace(/\s/g, "|");
        var final = valor.split(" ");

        let mes = 1

        for (let index = 0; index < final.length; index += 2) {
            if (index == 0) {
                $("#valppto" + mes).val((final[index].replace(/[$,]/g, '')).trim());
            } else {
                mes++;
                $("#valppto" + mes).val((final[index].replace(/[$,]/g, '')).trim());
            }
        }
        FnSumaCampos();

        $(this).val('');
    });

    $('#inputEmpresa').select2();
    $('#inputCentroC').select2();

    $('#BtnCrearPPTO').click(function () {

        var vacios = -1;

        $("#datappto-form input").each(function () {
            var valor = $(this).val();
            if (valor == '') {
                $("#" + this.id).addClass("bordeRojoValidacion");
                vacios++;
            } else {
                $("#" + this.id).removeClass("bordeRojoValidacion");
            }
        });

        $("#datappto-form select").each(function () {
            var valor = $(this).val();
            if (valor == '') {
                $("#" + this.id).addClass("bordeRojoValidacion");
                vacios++;
            } else {
                $("#" + this.id).removeClass("bordeRojoValidacion");
            }
        });

        if (vacios > 0) {
            FnNotificacion('Por favor asegurarse de llenar todos los campos obligatorios(*).', 'error');
        } else {
            CrearPresupuesto();
        }


    });

    $('#BtnRefreshPPTO').click(function () {

        $('#datappto-form input').prop('disabled', false);
        $('#datappto-form select').prop('disabled', false);

        $("#divPaso2").hide("slow");
        $("#BtnRefreshPPTO").hide("slow");
        $("#BtnCrearPPTO").show("slow");
        $('#datappto-form')[0].reset();
        $('#inputCentroC').val(null).trigger('change');
        $('#inputEmpresa').val(null).trigger('change');
        $("#keyppto").val('');
        $('#datatables-importesppto').DataTable().destroy();

    });

    $('#modalppto').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal 
        var id = button.data('id');
        $("#celda").val('');
        var modal = $(this)
        modal.find('.modal-title').text('Agregar Importes de Presupuesto');
        modal.find('.modal-body #keyepig').val(id);
        $("#resultadoppto").empty('');
        VisualizarImportes(id);
        $("#editarPresupesto input").each(function () {
            var valor = this.id;
        });
    });

    $("#FileInputExcel").change(function () {
        //alert('Hola');
        var cc = $('#inputCentroC').val();
        FnCargarArchExcel(cc);
    });

});

function FnSumaCampos() {
    var suma = parseInt($("#valppto1").val()) + parseInt($("#valppto2").val()) + parseInt($("#valppto3").val()) + parseInt($("#valppto4").val()) + parseInt($("#valppto5").val()) + parseInt($("#valppto6").val()) + parseInt($("#valppto7").val()) + parseInt($("#valppto8").val()) + parseInt($("#valppto9").val()) + parseInt($("#valppto10").val()) + parseInt($("#valppto11").val()) + parseInt($("#valppto12").val());
    $("#valTotal").val(suma);
}


function FnCargarArchExcel($cc) {
    var datas = new FormData($("#formExcel")[0]);
    $.ajax({
        data: datas,
        type: "POST",
        dataType: "html",
        contentType: false,
        processData: false,
        url: "/gacf-web-mexico/presupuesto/ajax/importarSaldosExcel_ajax.php?cc=" + $cc,
        beforeSend: function () {
            $("#barProgress").fadeIn();
            $("#barProgress").html('<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%">Cargando ....</div>');
        },
        success: function (data9) {
            //alert(data8);
            var json9 = eval("(" + data9 + ")");
            // archivo     = json9.archivo;
            // ruta        = json9.ruta;
            // mensaje     = json9.mensaje;
            // accion      = json9.accion;
            // opciones    = json9.opciones;
            msj = json9.msj;
            alerta = json9.alerta;
            FnNotificacion(msj, alerta);
            $("#barProgress").fadeOut();
            $("#FileInputExcel").val('');
            $('#modalpptoImportar').modal('hide');
            window.tablaimportesppto($('#keyppto').val());
        }

    });
}

function myFunction() {
    // Declare variables 
    var input, filter, table, tr, td, i, j, visible;
    input = document.getElementById("buscador");
    filter = input.value.toUpperCase();
    table = document.getElementById("resultado");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        visible = false;
        /* Obtenemos todas las celdas de la fila, no sólo la primera */
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                visible = true;
            }
        }
        if (visible === true) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}


function CrearPresupuesto() {
    $.ajax({
        data: $("#datappto-form").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/ajax/crearPresupuesto_ajax.php",
        beforeSend: function () {
            $("#barProgresspas2").fadeIn();
            $("#barProgresspas2").html('<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%">Cargando ....</div>');
            //$('#BtnCrearPPTO').prop('disabled', true);
        },
        success: function (data) {
            var json = eval("(" + data + ")");
            msj = json.msj;
            idppto = json.idppto;

            $("#barProgresspas2").fadeOut();
            $("#barProgresspas2").html('');
            if (msj == 'exito') {
                $("#keyppto").val(idppto);
                $("#keypptoExcel").val(idppto);
                window.tablaimportesppto($("#keyppto").val());
                $("#divPaso2").show("slow");
                //('#BtnCrearPPTO').prop('disabled', false);
                $("#BtnCrearPPTO").hide("slow");
                $("#BtnRefreshPPTO").show("slow");

                $('#datappto-form input').prop('disabled', true);
                $('#datappto-form select').prop('disabled', true);

                FnNotificacion('Se genero exitosamente la plantilla!', 'success');
                //$("#datatables-importesppto").DataTable().ajax.reload(); 
                //GenerarPlantilla(idppto);

            } else {
                $('#BtnCrearPPTO').prop('disabled', false);
                FnNotificacion('Tuvimos problemas al generar la plantilla', 'error');
            }
        }

    });
}

function GenerarPlantilla($idppto) {
    var idppto = $idppto;
    $.ajax({
        data: $("#datatable1-form").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/ajax/crearPlantilla_ajax.php?ppto=" + idppto,
        beforeSend: function () {
            $("#resultado").html("<img src='../images/loader1.gif' width='60' height='60' />");
        },
        success: function (data) {
            var json = eval("(" + data + ")");
            msj = json.msj;
            $("#resultado").empty('');
            $("#resultado").html(msj);

            $("#Divplantilla").show("slow");
        }

    });
}

function VisualizarImportes($idepi) {
    var idepi = $idepi;
    $.ajax({
        data: $("#editarppto-form").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/ajax/editarPresupuestoEpi_ajax.php?epi=" + idepi,
        success: function (data) {
            var json = eval("(" + data + ")");
            msj = json.msj;
            $("#barProgressimportes").fadeOut();
            $("#barProgressimportes").html('');
            $("#resultadoppto").empty('');
            $("#resultadoppto").html(msj);
            $("#divTablaEditarImportes").show("slow");

        }

    });
}

function FnGuardarPresupuesto() {
    $.ajax({
        data: $("#editarppto-form").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/pgm/editarPresupuestoEpi_pgm.php",
        beforeSend: function () {
            //$("#resultadoppto").html("<img src='../images/loader1.gif' width='60' height='60' />");
        },
        success: function (data) {
            var json = eval("(" + data + ")");
            band = json.band;
            msj = json.msj;
            alerta = json.alerta;
            FnNotificacion(msj, alerta);
            if (band == 1) {
                $('#modalppto').modal('hide');
                window.tablaimportesppto($('#keyppto').val());
            }

        }

    });
}

function FnCopiarCampos($keyMes) {
    var valor = $("#valppto" + $keyMes).val();
    var valpptoene = valor.replace(/\s/g, "|");
    var final = valpptoene.split("|");

    for (let index = 0; index < final.length; index += 2) {
        if (index == 0) {
            $("#valppto" + $keyMes).val(final[index].replace(/[$,]/g, ''));
        } else {
            $keyMes++;
            $("#valppto" + $keyMes).val(final[index].replace(/[$,]/g, ''));
        }
    }
    FnSumaCampos();
}