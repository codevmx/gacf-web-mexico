<?php require_once("../../header.php"); ?>

<script src="/gacf-web-mexico/presupuesto/js/carga-epigrafes.js"></script>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">     
                        <h4 class="page-title">Carga de Epígrafes</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Marketing</a></li>
                            <li class="breadcrumb-item active">Importar Catálogo</li>
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
                            <h5 class="page-title">Paso 1: Seleccionar Archivo en Formato CSV</h5>
                            <div class="form-group" id="div_input0">
                                <form id="cargarArchCSV" method="POST" action="" class="form form-validate form-horizontal" enctype="multipart/form-data">
                                    <input class="form-control" type="hidden" name="usuario" id="usuario" value="<?php echo $username; ?>" readonly>

                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="FileInput2" name="FileInput2">
                                            <button type="button" class="btn btn-success" id="BtnCargarCSV"><i class="bi bi-upload"></i> Cargar</button>
                                        </div>
                                    </div>

                                    <div class="progress mt-3" id="barProgresspas" style="display: none;"></div>

                                </form>
                            </div>
                            <div class="table-responsive" style="display:none" id="Divtable-epigrafes">
                                <table id="datatables-epigrafes" class="table table-striped dt-responsive nowrap w-100" >
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>Linea</th>
                                            <th>Cuenta JDE</th>
                                            <th>Epigrafe</th>
                                            <th>Clave</th>
                                            <th>Descripción del Gasto</th>
                                            <th>Motivo del Gasto</th>
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

    <?php require_once("../../footer.php"); ?>