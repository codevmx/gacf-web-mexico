<?php
include ("../../conexion/conexionODBC.php");
include ("../../conexion/conexion.php");
include ("../../conexion/functions.php");

$keypptoExcel = $_POST['keypptoExcel'];
$UploadDirectory = '../CSV/PTTOARCH/';
vaciarCarpeta($UploadDirectory);
$Random_Number = rand(0, 9999999999);
$archivo = strtolower($_FILES['FileInputExcel']['name']); // Nombre del archivo con extensión
$File_Ext = pathinfo($archivo, PATHINFO_EXTENSION); // Obtenemos la extensión
$file_info = pathinfo($archivo); // Obtenemos información sobre el archivo
$extraefile = explode('.' , $archivo);
$NewFileName = 'CargaSaldos_'.$keypptoExcel.'_'. $Random_Number . '.'. $File_Ext;
$creadir = @mkdir($UploadDirectory, 0777, true);
$datos = [];



if (move_uploaded_file($_FILES['FileInputExcel']['tmp_name'], $UploadDirectory . $NewFileName)) {
    // Incluir la librería PHPExcel
    require '../../../vendor/autoload.php';

    // Crear un nuevo objeto PHPExcel
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($UploadDirectory . $NewFileName);

    // Seleccionar la primera hoja del archivo Excel
    $hoja = $spreadsheet->getActiveSheet();

    // Obtener el número de filas y columnas en la hoja
    $numFilas = $hoja->getHighestRow();
    $numColumnas = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($hoja->getHighestColumn());
    // Recorrer cada fila
    for ($fila = 7; $fila <= $numFilas; $fila++) {
        // Recorrer cada columna
        for ($col = 1; $col <= $numColumnas; $col++) {

            if ($col == 2 || $col == 4 || $col >= 6) {
                // // Obtener el valor de la celda en la fila y columna actual
                // $valorCelda = $hoja->getCellByColumnAndRow($col, $fila)->getValue();
                if ($col == 2) {
                    $valorCeldaIndex = $hoja->getCellByColumnAndRow($col, $fila)->getValue();
                } else if ($col == 4) {
                    $valorCeldaIndexDos = $hoja->getCellByColumnAndRow($col, $fila)->getValue();
                } else if ($col >= 7) {
                    $valorCelda = $hoja->getCellByColumnAndRow($col, $fila)->getValue();
                    $datos[$valorCeldaIndex][$valorCeldaIndexDos] .= $valorCelda . ',';
                }
            }
        }
    }
    $BTBPPTOF = db_select("SELECT * FROM tb_mkt_presupuesto_det WHERe ID_presupuesto=" . $keypptoExcel . " ");
    

    foreach ($BTBPPTOF as $key) {
        $BTBEPIGRA = db_select("SELECT * FROM tb_mkt_epigrafes WHERe ID=" . $key['ID_epigrafe'] . " ");

        $DATOS = explode(',', trim($datos[$BTBEPIGRA[0]['cuentajde']][$BTBEPIGRA[0]['clave']]));

        if (!empty($datos[$BTBEPIGRA[0]['cuentajde']][$BTBEPIGRA[0]['clave']])) {
            $UTBPPTOCAB = db_query("UPDATE tb_mkt_presupuesto_det SET   pptoene=" . $DATOS[0] . ",
            pptofeb=" . $DATOS[1] . ",
            pptomar=" . $DATOS[2] . ",
            pptoabr=" . $DATOS[3] . ",
            pptomay=" . $DATOS[4] . ",
            pptojun=" . $DATOS[5] . ",
            pptojul=" . $DATOS[6] . ",
            pptoago=" . $DATOS[7] . ",
            pptosep=" . $DATOS[8] . ",
            pptooct=" . $DATOS[9] . ",
            pptonov=" . $DATOS[10] . ",
            pptodic=" . $DATOS[11] . ",
            estatus=1 WHERE ID_epigrafe=" . $key['ID_epigrafe'] . " AND ID_presupuesto = " . $key['ID_presupuesto'] . "");
        }
    }
    $ar['msj'] = '<strong>Exito!</strong> Se cargaron los saldos correctamente';
    $ar['alerta'] = 'success';
}else {
    $ar['msj'] = '<strong>Error!</strong> No se pudo cargar su archivo correctamente!';
    $ar['alerta'] = 'error';
}

$dato_json   = json_encode($ar);
echo $dato_json;
