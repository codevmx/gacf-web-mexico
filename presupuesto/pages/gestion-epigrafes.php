<?php require_once("../../header.php"); ?>


<script type="text/javascript">
    $(document).ready(function() {

        $("#inputCuenta").select2({
            dropdownParent: $('#modalAgregarEpigrafe'),
            language: {

                noResults: function() {

                    return "No hay resultado";
                },
                searching: function() {

                    return "Buscando..";
                }
            }
        });
        ConsultaEpigrafes();
        //$('#inputCuenta').select2();

        $('#eliminarEPGF').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal 
            var id = button.data('id');

            var modal = $(this)
            modal.find('.modal-title').text('Eliminar Registro');
            modal.find('.modal-body #keyepig').val(id);
        });

        $("#BtnConfiElim").click(function() {
            EliminarEpigrafes();
        });

        $("#BtnConfiCrear").click(function() {
            CrearEpigrafes();
        });

    });

    function ConsultaEpigrafes() {

        $.ajax({
            data: $("#formCC").serialize(),
            type: "POST",
            dataType: "html",
            url: "mkt/gestionEpigrafes_ajax.php",
            beforeSend: function() {
                $("#resultado").html("<img src='../images/loader1.gif' width='60' height='60' />");
            },
            success: function(data) {
                var json = eval("(" + data + ")");
                msj = json.msj;
                $("#resultado").empty('');
                $("#resultado").html(msj);
            }

        });
    }

    function EliminarEpigrafes() {
        var accion = 'eliminar';
        $.ajax({
            data: $("#formElimepig").serialize(),
            type: "POST",
            dataType: "html",
            url: "mkt/gestionEpigrafes_pgm.php?accion=" + accion,

            success: function(data1) {

                var json1 = eval("(" + data1 + ")");
                msj1 = json1.msj;

                $("#DivMsj").empty('');
                $("#DivMsj").append(msj1);
                $('#eliminarEPGF').modal('toggle')
                ConsultaEpigrafes()

            }

        });
    }


    function CrearEpigrafes() {
        var accion = 'crear';
        $.ajax({
            data: $("#formCrearepig").serialize(),
            type: "POST",
            dataType: "html",
            url: "mkt/gestionEpigrafes_pgm.php?accion=" + accion,

            success: function(data2) {

                var json2 = eval("(" + data2 + ")");
                msj2 = json2.msj;

                $("#DivMsj").empty('');
                $("#DivMsj").append(msj2);

                $("#inputCuenta").val('');
                $("#inputEpig").val('');
                $("#inputClave").val('');
                $("#inputDesGasto").val('');
                $("#inputMotGasto").val('');


                $('#crearEPGF').modal('toggle')
                ConsultaEpigrafes()

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
                        <h4 class="page-title">Administración de Epígrafes</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Marketing</a></li>
                            <li class="breadcrumb-item active">Mantenimiento</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <strong>Instrucciones : </strong> Deberá seleccionar el Epigrafe que desea actualizar de la siguiente consulta, podrá realizar las acciones de crear, actualizar y eliminar registros.
                            </div>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarEpigrafe"><i class="bi bi-plus-square-dotted"></i> Nuevo Epigrafe </button>
                            <h5 class="page-title pt-3 pb-2">Consulta General</h5>
                            <div class="table-responsive">
                                <table id="datatables-gestionEpigrafes" class="table table-striped dt-responsive nowrap w-100">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>Linea</th>
                                            <th>Cuenta JDE</th>
                                            <th>Epigrafe</th>
                                            <th>Clave</th>
                                            <th>Descripción del Gasto</th>
                                            <th>Motivo del Gasto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar Motivo -->
<div id="eliminarEPGF" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title" id="standard-modalLabel">Eliminar Registro</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formElimepig" method="POST">
                    <input type="hidden" name="keyepig" id="keyepig" readonly>
                    ¿Esta Seguro de Eliminar el Registro?
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="BtnConfiElim">Confirmar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para agregar Motivo -->
<div id="modalAgregarEpigrafe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title" id="standard-modalLabel">Crear Registro</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-validate" id="formCrearepig" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="simpleinput" class="form-label">Cuenta</label>
                        <select class="form-control select2" tabindex="-1" data-toggle="select2" id="inputCuenta">
                            <option>Select</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputEpig" class="form-label">Epígrafe</label>
                        <input type="text" class="form-control" id="inputEpig" name="inputEpig" placeholder="Capturar el nombre del Epígrafe" required />
                    </div>
                    <div class="mb-3">
                        <label for="inputClave" class="form-label">Clave</label>
                        <input type="text" class="form-control" id="inputClave" name="inputClave" placeholder="Clave Identificador (Clave Corta)" required />
                    </div>
                    <div class="mb-3">
                        <label for="inputDesGasto" class="form-label">Descripción del Gasto:</label>
                        <input type="text" class="form-control" id="inputDesGasto" name="inputDesGasto" placeholder="Descripción de Gasto" required />
                    </div>
                    <div class="mb-3">
                        <label for="inputMotGasto" class="form-label">Motivo del Gasto:</label>
                        <input type="text" class="form-control" id="inputMotGasto" name="inputMotGasto" placeholder="Motivo del Gasto" required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="BtnConfiCrear">Confirmar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require_once("../../footer.php"); ?>