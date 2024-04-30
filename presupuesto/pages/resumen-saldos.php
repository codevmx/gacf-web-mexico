<?php require_once ("../../header.php"); ?>


<script src="/gacf-web-mexico/presupuesto/js/resumen-saldos.js"></script>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Resumen de Plantillas</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Presupuesto - Presini</li>
                            <li class="breadcrumb-item active">Resumen</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatables-resumenPlantillas"
                                    class="table table-striped dt-responsive nowrap w-100">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Centro de Costos</th>
                                            <th>Empresa</th>
                                            <th>Año</th>
                                            <th>Total PPTO</th>
                                            <th>Total Real</th>
                                            <th>Estatus</th>
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
            <div class="row" style="display:none;" id="divTablaResumen">
                <div class="col-12">
                    <div class="card" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Detalle de la Plantilla</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <input type="hidden" name="keyPTTO" id="keyPTTO">
                                <div class="col-4"><strong>Centro de Costos: </strong><p id="centroCostos"></p></div>
                                <div class="col-4"><strong>Empresa: </strong><p id="empresa"></p></div>
                                <div class="col-4"><strong>Año: </strong><p id="anio"></p></div>
                            </div>
                            <hr>
                            <div class="table-responsive mt-3" >
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

    <?php require_once ("../../footer.php"); ?>