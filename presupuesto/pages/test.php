<?php require_once("../../header.php"); ?>


<script type="text/javascript">
    $(document).ready(function() {

        $('#BtnCargarCSV').click(function() {
            $("#cargarArchCSV").ajaxSubmit(options2);

            // always return false to prevent standard browser submit and page navigation 
            return false;
        });

        var options2 = {
            target: '#outputDes2', // target element(s) to be updated with server response 
            beforeSubmit: beforeSubmit2, // pre-submit callback 
            success: afterSuccess2, // post-submit callback 
            uploadProgress: OnProgress2, //upload progress callback 
            resetForm: true, // reset the form after successful submit 
            url: "mkt/importarEpigrafes_ajax.php"
        };

    });


    function afterSuccess2(data) {
        $('#BtnCargarCSV').show(); //hide submit button
        $('#loading-img2').hide(); //hide submit button
        $('#progressbox2').delay(1000).fadeOut(); //hide progress bar

        var json = eval("(" + data + ")");

        mensajes = json.mensajes2;
        archivo = json.archivo;
        ubicacion = json.ubicacion;
        datos = json.datos;

        $("#output2").html(mensajes);
        $("#resultado").html("<hr>" + datos + "<hr>");


        //$('#subirPDF').modal().hide();
        //$('#subirPDF').modal('toggle');
        //consultaComPagoArch();
        //$("#output2").html('');
        //AGREGAR FUNCION DE CONSULTA DE ARCHIVOS JCSD 20180912
        //filtrarArchivos(); // COMENTADO CONSULTA JCSD PARA PRUEBAS
    }

    function OnProgress2(event, position, total, percentComplete) {
        //Progress bar
        $('#progressbox2').show();
        $('#progressbar2').width(percentComplete + '%') //update progressbar percent complete
        $('#statustxt2').html(percentComplete + '%'); //update status text
    }

    function beforeSubmit2() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob) {

            /*if( !$('#empS').val()) //check empty input filed
            {
                $("#output2").html("<div class='alert alert-danger'><strong>Error!</strong> Antes de continuar, selecciona una empresa.</div>");
                return false
            }*/

            if (!$('#FileInput2').val()) //check empty input filed
            {
                $("#output2").html("<div class='alert alert-danger'><strong>Error!</strong> Antes de continuar, selecciona un archivo valido.</div>");
                return false
            }

            var fsize2 = $('#FileInput2')[0].files[0].size; //get file size
            var ftype2 = $('#FileInput2')[0].files[0].type; // get file type


            //allow file types 
            switch (ftype2) {
                //case 'text/xml':
                case 'text/csv':
                    break;
                default:
                    $("#output2").html("<div class='alert alert-danger'><strong>Error!</strong> Ingresar unicamente archivos con extensión CSV!</div>");
                    return false
            }

            //Allowed file size is less than 5 MB (1048576)
            if (fsize2 > 5242880) {
                $("#output2").html("<div class='alert alert-danger'><strong>Error!</strong> <b>" + bytesToSize(fsize2) + "</b> Archivo muy grande! <br />El archivo es demasiado grande, debe ser inferior a 5 MB.</div>");
                return false
            }

            $('#BtnCargarCSV').hide(); //hide submit button
            $('#loading-img2').show(); //hide submit button
            $("#output2").html("");
        } else {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#output2").html("<div class='alert alert-danger'><strong>Error!</strong> Actualiza tu navegador, debido a que su navegador actual carece de algunas características nuevas que necesitamos!</div>");
            return false;
        }
    }
</script>

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
                                    <input type="hidden" name="usuario" id="usuario" value="<?php echo $username; ?>" readonly>

                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="FileInput2" name="FileInput2">
                                            <button type="button" class="btn btn-primary" id="BtnCargarCSV"><i class="glyphicon glyphicon-cloud-upload"></i> Cargar</button>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">

                                        <div class="progress" id="progressbox2" style="display:none;">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar2" id="progressbar2" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                <span id="statustxt2">0%</span>
                                            </div>
                                        </div>

                                        <div style="width:100%;text-align:center;display:none;" id="loading-img2">
                                            <h5>Por favor espere, estamos cargando el archivo...</h5>
                                            <img src="images/loader1.gif" alt="Por favor espere, estamos subiendo su documento..." width="60" height="60" />
                                        </div>

                                        <div id="resultado"></div>
                                        <div id="outputDes2" style="display: none;"></div>

                                    </div>

                                </form>
                            </div>
                            <div class="table-responsive">
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