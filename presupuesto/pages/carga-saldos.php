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
                                        <label for="anio" class="form-label">Año (<span
                                                class="text-danger">*</span>)</label>
                                        <input class="form-control " type="number" id="anio" name="anio" min="2023"
                                            max="3000" placeholder="Año">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputCentroC" class="form-label">Centro de Costos (<span
                                                class="text-danger">*</span>)</label>
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
                                        <label for="inputEmpresa" class="form-label">Empresa (<span
                                                class="text-danger">*</span>)</label>
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
                            <div class="progress mt-3" id="barProgresspas2" style="display: none;"></div>
                            <!-- <input class="form-control " type="text" id="buscador" onkeyup="myFunction()" placeholder="Buscar.."> -->
                            <div class="mt-3" id="divPaso2" style="display:none;">
                                <h5 class="page-title mt-3">Paso 2: Pre-Visualización de Plantilla para ingresar
                                    importes
                                    PPTO</h5>
                                <a href="/gacf-web-mexico/presupuesto/pages/download-mkt-plantilla.php">
                                    <button class="btn btn-warning" type="button"><i class="bi bi-cloud-download"></i>
                                        Descargar Plantilla</button>
                                </a>
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalpptoImportar">
                                    <i class="bi bi-cloud-upload"></i>
                                    Importar Presupuesto
                                </button>
                                <div class="table-responsive mt-3">
                                    <table id="datatables-importesppto"
                                        class="table table-striped nowrap row-border order-column w-100">
                                        <!--  id="makeEditable" -->
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th>Epigrafe</th>
                                                <th>Clave</th>
                                                <th>Descripción Gasto</th>
                                                <th>Motivo Gasto</th>
                                                <th class="table-danger">Real Enero</th>
                                                <th class="table-info">PTTO Enero</th>
                                                <th class="table-danger">Real Febrero</th>
                                                <th class="table-info">PTTO Febrero</th>
                                                <th class="table-danger">Real Marzo</th>
                                                <th class="table-info">PTTO Marzo</th>
                                                <th class="table-danger">Real Abril</th>
                                                <th class="table-info">PTTO Abril</th>
                                                <th class="table-danger">Real Mayo</th>
                                                <th class="table-info">PTTO Mayo</th>
                                                <th class="table-danger">Real Junio</th>
                                                <th class="table-info">PTTO Junio</th>
                                                <th class="table-danger">Real Julio</th>
                                                <th class="table-info">PTTO Julio</th>
                                                <th class="table-danger">Real Agosto</th>
                                                <th class="table-info">PTTO Agosto</th>
                                                <th class="table-danger">Real Septiembre</th>
                                                <th class="table-info">PTTO Septiembre</th>
                                                <th class="table-danger">Real Octubre</th>
                                                <th class="table-info">PTTO Octubre</th>
                                                <th class="table-danger">Real Noviembre</th>
                                                <th class="table-info">PTTO Noviembre</th>
                                                <th class="table-danger">Real Diciembre</th>
                                                <th class="table-info">PTTO Diciembre</th>
                                                <th>Acciones</th>
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

<!-- Modal para Agregar de Importes PPTO -->
<div id="modalppto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h4 class="modal-title" id="standard-modalLabel">Agregar Importes de Presupuesto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editarppto-form" method="POST">
                    <input class="form-control" type="hidden" name="keyepig" id="keyepig" readonly>
                    <div class="col-md-12">
                        <label for="anio" class="form-label">Aquí puede copiar una fila completa desde un archivo Excel, respetando el orden y numero de columnas establecidas.</label>
                        <input class="form-control" type="text" name="celda" id="celda"
                            placeholder="Ingresar datos de copiado">
                    </div>
                    <div class="progress mt-3" id="barProgressimportes" style="display: none;"></div>
                    <div class="table-responsive" id="divTablaEditarImportes" style="display:none;">
                        <table class="table table-striped dt-responsive nowrap w-100 mt-3" id="editarPresupesto">
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
                            <tbody id="resultadoppto" >
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info" onclick="FnGuardarPresupuesto()">Confirmar <i class="bi bi-check2-all"></i></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para Importar datos con Excel -->
<div id="modalpptoImportar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title" id="standard-modalLabel">Importar datos con Excel</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formExcel" action="" method="post" enctype="multipart/form-data">
                    <input class="form-control " type="hidden" name="keypptoExcel" id="keypptoExcel" readonly>

                    <div class="form-group" id="InputCargaArch">
                        <label for="FileInputExcel">Subir Archivo:</label>
                        <input name="FileInputExcel" id="FileInputExcel" type="file" class="form-control"
                            accept=".xlsx, .xls, .csv" />
                    </div>
                    <div class="progress" id="barProgress" style="display: none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require_once ("../../footer.php"); ?>