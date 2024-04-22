$(document).ready(function () {
    //window.tablaimportesppto(1);

    // Funcion para repartir datos de un excel
    $('#celda').on('input', function () {
        // Obtener el valor del campo de entrada
        var valor = $(this).val();
        var textoSinEspacios = valor.trim();
        // Verificar si el campo está lleno o vacío
        if (valor) {

            var valpptoene = textoSinEspacios.split(" ")[0];
            $("#valpptoene").val(valpptoene.replace(/,/g, ''));

            var pptofeb = textoSinEspacios.split(" ")[2];
            $("#valpptofeb").val(pptofeb.replace(/,/g, ''));

            var pptomar = textoSinEspacios.split(" ")[4];
            $("#valpptomar").val(pptomar.replace(/,/g, ''));

            var pptoabr = textoSinEspacios.split(" ")[6];
            $("#valpptoabr").val(pptoabr.replace(/,/g, ''));

            var pptomay = textoSinEspacios.split(" ")[8];
            $("#valpptomay").val(pptomay.replace(/,/g, ''));

            var pptojun = textoSinEspacios.split(" ")[10];
            $("#valpptojun").val(pptojun.replace(/,/g, ''));

            var pptojul = textoSinEspacios.split(" ")[12];
            $("#valpptojul").val(pptojul.replace(/,/g, ''));

            var pptoago = textoSinEspacios.split(" ")[14];
            $("#valpptoago").val(pptoago.replace(/,/g, ''));

            var pptosep = textoSinEspacios.split(" ")[16];
            $("#valpptosep").val(pptosep.replace(/,/g, ''));

            var pptooct = textoSinEspacios.split(" ")[18];
            $("#valpptooct").val(pptooct.replace(/,/g, ''));

            var pptonov = textoSinEspacios.split(" ")[20];
            $("#valpptonov").val(pptonov.replace(/,/g, ''));

            var pptodic = textoSinEspacios.split(" ")[22];
            $("#valpptodic").val(pptodic.replace(/,/g, ''));

            if (textoSinEspacios.split(" ").length > 23) {
                var valTotal = textoSinEspacios.split(" ")[24];
                $("#valTotal").val(valTotal.replace(/,/g, ''));
            } else {
                FnSumaCampos();
            }

            $(this).val('');

        }

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
            FnNotificacion('<strong>Error!</strong> Por favor asegurarse de llenar todos los campos obligatorios(*).', 'error');
        } else {
            CrearPresupuesto();
        }


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
    });

    $("#FileInputExcel").change(function () {
        //alert('Hola');
        FnCargarArchExcel();
    });

});

function FnSumaCampos() {
    var suma = parseInt($("#valpptoene").val()) + parseInt($("#valpptofeb").val()) + parseInt($("#valpptomar").val()) + parseInt($("#valpptoabr").val()) + parseInt($("#valpptomay").val()) + parseInt($("#valpptojun").val()) + parseInt($("#valpptojul").val()) + parseInt($("#valpptoago").val()) + parseInt($("#valpptosep").val()) + parseInt($("#valpptooct").val()) + parseInt($("#valpptonov").val()) + parseInt($("#valpptodic").val());
    $("#valTotal").val(suma);
}


function FnCargarArchExcel() {
    var datas = new FormData($("#formExcel")[0]);
    $.ajax({
        data: datas,
        type: "POST",
        dataType: "html",
        contentType: false,
        processData: false,
        url: "/gacf-web-mexico/presupuesto/ajax/importarSaldosExcel_ajax.php",
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
            $('#BtnCrearPPTO').prop('disabled', true);
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
                window.tablaimportesppto(idppto);
                $("#divPaso2").fadeIn();
                $("#BtnCrearPPTO").fadeOut();
                FnNotificacion('<strong>Exito!</strong> Se genero correctamente la plantilla!', 'success');
                //$("#datatables-importesppto").DataTable().ajax.reload(); 
                //GenerarPlantilla(idppto);

            }else{
                $('#BtnCrearPPTO').prop('disabled', false);
                FnNotificacion('<strong>Error!</strong> Tuvimos problemas al generar la plantilla', 'error');
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
        beforeSend: function () {
            $("#barProgressimportes").fadeIn();
            $("#barProgressimportes").html('<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%">Cargando ....</div>');
        },
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