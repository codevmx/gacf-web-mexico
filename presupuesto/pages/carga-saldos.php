<?php require_once("../../header.php"); ?>

<style>
    .bordeRojoValidacion {
        border-color: #d02b4e9e;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {

        // Funcion para repartir datos de un excel
        $('#celda').on('input', function() {
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

        $('#BtnCrearPPTO').click(function() {

            var vacios = -1;

            $("#datappto-form input").each(function() {
                var valor = $(this).val();
                if (valor == '') {
                    $("#" + this.id).addClass("bordeRojoValidacion");
                    vacios++;
                } else {
                    $("#" + this.id).removeClass("bordeRojoValidacion");
                }
            });

            $("#datappto-form select").each(function() {
                var valor = $(this).val();
                if (valor == '') {
                    $("#" + this.id).addClass("bordeRojoValidacion");
                    vacios++;
                } else {
                    $("#" + this.id).removeClass("bordeRojoValidacion");
                }
            });

            if (vacios > 0) {
                $("#divAlert").html('<div class="alert alert-danger"><h4>Error! <small>Por favor asegurarse de llenar todos los campos obligatorios(*).</small></h4></div>');
            } else {
                CrearPresupuesto();
            }


        });

        $('#modalppto').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal 
            var id = button.data('id');
            $("#celda").val('');
            var modal = $(this)
            modal.find('.modal-title').text('Agregar de Importes PPTO');
            modal.find('.modal-body #keyepig').val(id);

            VisualizarImportes(id);
        });

        $("#FileInputExcel").change(function() {
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
            url: "mkt/leer_archivo_presupuesto_ajax.php",
            beforeSend: function() {
                $("#barProgress").fadeIn();
                $("#barProgress").html('<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%">Cargando ....</div>');
            },
            success: function(data9) {
                //alert(data8);
                var json9 = eval("(" + data9 + ")");
                // archivo     = json9.archivo;
                // ruta        = json9.ruta;
                // mensaje     = json9.mensaje;
                // accion      = json9.accion;
                // opciones    = json9.opciones;

                $("#barProgress").fadeOut();
                $("#FileInputExcel").val('');
                GenerarPlantilla($('#keyppto').val());
                $('#modalpptoImportar').modal('hide');
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
            url: "mkt/crearPresupuesto_ajax.php",
            success: function(data) {
                var json = eval("(" + data + ")");
                msj = json.msj;
                idppto = json.idppto;

                if (msj == 'exito') {
                    $("#keyppto").val(idppto);
                    $("#keypptoExcel").val(idppto);
                    GenerarPlantilla(idppto);
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
            url: "mkt/crearPlantilla_ajax.php?ppto=" + idppto,
            beforeSend: function() {
                $("#resultado").html("<img src='../images/loader1.gif' width='60' height='60' />");
            },
            success: function(data) {
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
            url: "presupuesto/ajax/editarPresupuestoEpi_ajax.php?epi=" + idepi,
            beforeSend: function() {
                //$("#resultadoppto").html("<img src='../images/loader1.gif' width='60' height='60' />");
            },
            success: function(data) {
                alert(data);
                var json = eval("(" + data + ")");
                msj = json.msj;
                $("#resultadoppto").empty('');
                $("#resultadoppto").html(msj);

            }

        });
    }

    function FnGuardarPresupuesto() {
        $.ajax({
            data: $("#editarppto-form").serialize(),
            type: "POST",
            dataType: "html",
            url: "mkt/editarPresupuestoEpi_pgm.php",
            beforeSend: function() {
                $("#resultadoppto").html("<img src='../images/loader1.gif' width='60' height='60' />");
            },
            success: function(data) {
                var json = eval("(" + data + ")");
                band = json.band;
                if (band == 1) {
                    $('#modalppto').modal('hide');
                    GenerarPlantilla($('#keyppto').val());
                }

            }

        });
    }
</script>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Carga de Saldos Iniciales</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Presupuesto - Presini</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <strong>Instrucciones : </strong> Se solo se recibirán archivos en formato CSV y se deberá respetar el orden y la cantidad de columnas establecidas para obtener una importación exitosa.
                            </div>
                            <h5 class="page-title">Paso 1: Ingresar datos de registro</h5>
                            <form id="datappto-form" method="POST" action="" class="form form-validate form-horizontal">
                                <input class="form-control " type="hidden" name="keyppto" id="keyppto" readonly>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="anio" class="form-label">Año</label>
                                        <input class="form-control " type="number" id="anio" name="anio" min="2023" max="3000" placeholder="Año">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputCentroC" class="form-label">Centro de Costos</label>
                                        <select class="form-control " id="inputCentroC" name="inputCentroC" style="width: 100%;">
                                            <?php
                                            // echo '<option value="" selected>Seleccionar Centro de Costos (<span class="text-danger">*</span>)</option>';
                                            // $datosCC = db_selectODBC("SELECT TLCDEE,TLNMEL FROM BIM00F.MLINTB WHERE TLCDTB='02602' ORDER BY TLNMEL");
                                            // foreach ($datosCC as $keyCC) {
                                            //     echo '<option value="' . trim($keyCC['TLCDEE']) . '">' . $keyCC['TLCDEE'] . ' | ' . utf8_encode($keyCC['TLNMEL']) . '</option>';
                                            //     ob_flush();
                                            //     flush();
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputEmpresa" class="form-label">Empresa</label>
                                        <select class="form-control " id="inputEmpresa" name="inputEmpresa" style="width: 100%;">
                                            <?php
                                            // echo '<option value="" selected>Seleccionar Empresa (<span class="text-danger">*</span>)</option>';
                                            // $BTBEMPRESAS = "SELECT * FROM empresas";
                                            // $RTBEMPRESAS = db_select($BTBEMPRESAS);
                                            // foreach ($RTBEMPRESAS as $keyEmpresa) {
                                            //     echo ' <option value="' . $keyEmpresa['cia'] . '">' . $keyEmpresa['razon'] . '</option>';
                                            //     ob_flush();
                                            //     flush();
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" id="BtnCrearPPTO"><i class="bi bi-file-ruled"></i> Crear Plantilla</button>
                            </div>
                            <h5 class="page-title mt-3">Paso 2: Pre-Visualización de Plantilla para ingresar importes PPTO</h5>
                            <input class="form-control " type="text" id="buscador" onkeyup="myFunction()" placeholder="Buscar..">
                            <div class="mt-3">
                                <a href="download_mkt_plantilla.php">
                                    <button class="btn btn-warning" type="button"><i class="bi bi-cloud-download"></i> Descargar Plantilla</button>
                                </a>
                                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalppto">
                                    <i class="bi bi-cloud-upload"></i>
                                    Importar Presupuesto
                                </button>
                                <div class="table-responsive mt-3">
                                    <table id="datatables-importesppto" class="table table-striped dt-responsive nowrap w-100"><!--  id="makeEditable" -->
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th>Linea</th>
                                                <th>Cuenta JDE</th>
                                                <th>Epigrafe</th>
                                                <th>Clave</th>
                                                <th>Descripción Gasto</th>
                                                <th>Motivo Gasto</th>
                                                <th>Estatus</th>
                                                <th>Total </th>
                                                <th>Asignar</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Registro -->
<div id="modalppto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title" id="standard-modalLabel">Agregar de Importes PPTO</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editarppto-form" method="POST">
                    <input class="form-control" type="hidden" name="keyepig" id="keyepig" readonly>
                    <div class="col-md-12">
                        <label for="anio" class="form-label">Ingresar todos los datos</label>
                        <input class="form-control" type="text" name="celda" id="celda" placeholder="Ingrese datos de copiado">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped dt-responsive nowrap w-100 mt-3">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th class="col-1">Enero</th>
                                    <th class="col-1">Febrero</th>
                                    <th class="col-1">Marzo</th>
                                    <th class="col-1">Abril</th>
                                    <th class="col-1">Mayo</th>
                                    <th class="col-1">Junio</th>
                                    <th class="col-1">Julio</th>
                                    <th class="col-1">Agosto</th>
                                    <th class="col-1">Septiembre</th>
                                    <th class="col-1">Octubre</th>
                                    <th class="col-1">Noviembre</th>
                                    <th class="col-1">Diciembre</th>
                                </tr>
                            </thead>
                            <tbody id="resultadoppto">
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="FnGuardarPresupuesto()">Confirmar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require_once("../../footer.php"); ?>