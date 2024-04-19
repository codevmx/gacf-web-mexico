<?php require_once ("../../header.php"); ?>

<script src="/gacf-web-mexico/presupuesto/js/carga-saldos.js"></script>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
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
                                <strong>Instrucciones : </strong> Se solo se recibirán archivos en formato CSV y se
                                deberá respetar el orden y la cantidad de columnas establecidas para obtener una
                                importación exitosa.
                            </div>
                            <h5 class="page-title">Paso 1: Ingresar datos de registro</h5>
                            <form id="datappto-form" method="POST" action="" class="form form-validate form-horizontal">
                                <input class="form-control " type="hidden" name="keyppto" id="keyppto" readonly>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="anio" class="form-label">Año (<span class="text-danger">*</span>)</label>
                                        <input class="form-control " type="number" id="anio" name="anio" min="2023"
                                            max="3000" placeholder="Año">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputCentroC" class="form-label">Centro de Costos (<span class="text-danger">*</span>)</label>
                                        <select class="form-control " id="inputCentroC" name="inputCentroC"
                                            style="width: 100%;">
                                            <?php
                                            echo '<option value="">Seleccionar opción</option>';
                                            $datosCC = db_selectODBC("SELECT TLCDEE,TLNMEL FROM BIM00F.MLINTB WHERE TLCDTB='02602' ORDER BY TLNMEL");
                                            foreach ($datosCC as $keyCC) {
                                                echo '<option value="' . trim($keyCC['TLCDEE']) . '">' . $keyCC['TLCDEE'] . ' | ' . $keyCC['TLNMEL'] . '</option>';
                                                ob_flush();
                                                flush();
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputEmpresa" class="form-label">Empresa (<span class="text-danger">*</span>)</label>
                                        <select class="form-control " id="inputEmpresa" name="inputEmpresa"
                                            style="width: 100%;">
                                            <?php
                                            echo '<option value="">Seleccionar opción</option>';
                                            $BTBEMPRESAS = "SELECT * FROM empresas";
                                            $RTBEMPRESAS = db_select($BTBEMPRESAS);
                                            foreach ($RTBEMPRESAS as $keyEmpresa) {
                                                echo ' <option value="' . $keyEmpresa['cia'] . '">' . $keyEmpresa['razon'] . '</option>';
                                                ob_flush();
                                                flush();
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" id="BtnCrearPPTO"><i
                                        class="bi bi-file-ruled"></i> Crear Plantilla</button>
                            </div>
                            <h5 class="page-title mt-3">Paso 2: Pre-Visualización de Plantilla para ingresar importes
                                PPTO</h5>
                            <!-- <input class="form-control " type="text" id="buscador" onkeyup="myFunction()" placeholder="Buscar.."> -->
                            <div class="mt-3">
                                <a href="download_mkt_plantilla.php">
                                    <button class="btn btn-warning" type="button"><i class="bi bi-cloud-download"></i>
                                        Descargar Plantilla</button>
                                </a>
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalppto">
                                    <i class="bi bi-cloud-upload"></i>
                                    Importar Presupuesto
                                </button>
                                <div class="table-responsive mt-3">
                                    <table id="datatables-importesppto"
                                        class="table table-striped dt-responsive nowrap w-100">
                                        <!--  id="makeEditable" -->
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
<div id="modalppto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
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
                        <input class="form-control" type="text" name="celda" id="celda"
                            placeholder="Ingrese datos de copiado">
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

<?php require_once ("../../footer.php"); ?>