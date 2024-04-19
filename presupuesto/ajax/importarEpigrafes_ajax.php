<?php
include ("../../conexion/conexionODBC.php");
include ("../../conexion/conexion.php");
include ("../../conexion/functions.php");

$date_rec   = date('Ymd') . '_' . date('His');
$ubi_arch   = '../CSV/Epigrafes/';
vaciarCarpeta($ubi_arch);
$usuario    = trim($_POST['usuario']);
$archivo    = strtolower($_FILES['FileInput2']['name']); // Nombre del archivo con extensión
$File_Ext   = pathinfo($archivo, PATHINFO_EXTENSION); // Obtenemos la extensión
$file_info  = pathinfo($archivo); // Obtenemos información sobre el archivo

if (isset($archivo) && $file_info['error'] == UPLOAD_ERR_OK) {


    $UploadDirectory    = $ubi_arch;
    $creadir            = @mkdir($UploadDirectory, 0777, true);
    
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        die();
    }

    if ($file_info["size"] > 5242880) {
        $ar['msj'] = "<strong>Error!</strong> Archivo demasiado grande!";
        $ar['alerta'] = 'error';
    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		Tipo de archivo
    switch ($File_Ext) {
        case 'csv':
            break;
        default:
            $ar['msj'] = "<strong>Error!</strong> Archivo no soportado , ingresar documentos en formato CSV!";
            $ar['alerta'] = 'error';
    }

    $Random_Number  = rand(100, 99999999);
    $NewFileName    = 'CATMKTEPI_' . $date_rec . '_' . $Random_Number . '.' .$File_Ext;

    if (move_uploaded_file($_FILES['FileInput2']['tmp_name'], $UploadDirectory . $NewFileName)) {

        $truncarTb = "DELETE FROM tb_mkt_epigrafes WHERE 1=1"; 
        $truncarTb = db_query($truncarTb) or die('Error al limpiar tabla de paso ') ;

        $truncarTbInicio = "ALTER TABLE tb_mkt_epigrafes AUTO_INCREMENT = 1"; 
        $truncarTbInicio = db_query($truncarTbInicio) or die('Error al inicializar tabla de paso ') ;

        $csv_file = fopen($UploadDirectory.$NewFileName, 'r');
        while(($data = fgetcsv($csv_file, 1000, ",")) !== FALSE){
            $RV_001 = '';
            $RV_002 = '';
            $RV_003 = '';

            $linea      = trim($data[0]);
            $cuentatg   = trim($data[1]);
            $cuentajde  = trim($data[2]);
            $epigrafe   = utf8_decode(trim($data[3]));
            $clave      = trim($data[4]);
            $desgasto   = utf8_decode(trim($data[5]));
            $motgasto   = utf8_decode(trim($data[6]));

            if($linea!='' && $cuentajde!='' && $epigrafe!='' && $clave!='' && $desgasto!='' && $motgasto!='' ){
                    $ITBEPI = db_query("INSERT INTO tb_mkt_epigrafes (cuentatg,cuentajde,epigrafe,clave,desgasto,motgasto)VALUES('".$cuentatg."','".$cuentajde."','".$epigrafe."','".$clave."','".$desgasto."','".$motgasto."')");
            }else{
                $ar['msj'] = "<strong>Error!</strong> Se encontraron datos vacios, validar.";
                $ar['alerta'] = 'error';
            }
        }

        fclose($csv_file);


        $ar['msj']          = "<strong>Exito!</strong> Se cargo su archivo exitosamente! ";
        $ar['alerta']     = 'success';
        $ar['archivo']      = $NewFileName;
        $ar['ubicacion']    = $UploadDirectory;

    } else {

        $ar['msj'] = "<strong>Error!</strong> No se pudo cargar su archivo correctamente! ";
        $ar['alerta'] = 'error';
    }

} else {
    $ar['msj'] = "<strong>Error!</strong> Archivo demasiado grande! Is 'upload_max_filesize'  ";
    $ar['alerta'] = 'error';
}

$dato_json = json_encode($ar);
echo $dato_json;
