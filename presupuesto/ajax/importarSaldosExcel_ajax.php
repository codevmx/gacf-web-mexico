<?php
include ("../../conexion/conexionODBC.php");
include ("../../conexion/conexion.php");
include ("../../conexion/functions.php");



$keypptoExcel       = $_POST['keypptoExcel'];
$keycc              = $_GET['cc'];
$UploadDirectory    = '../csv/ppto/';
vaciarCarpeta($UploadDirectory);
$Random_Number      = rand(0, 9999999999);
$archivo            = strtolower($_FILES['FileInputExcel']['name']); // Nombre del archivo con extensión
$File_Ext           = pathinfo($archivo, PATHINFO_EXTENSION); // Obtenemos la extensión
$file_info          = pathinfo($archivo); // Obtenemos información sobre el archivo
$extraefile         = explode('.' , $archivo);
$NewFileName        = 'Presini_'.$keypptoExcel.'_'. $Random_Number . '.'. $File_Ext;
$creadir            = @mkdir($UploadDirectory, 0777, true);
$datos              = [];

if(strpos(trim($archivo),$keycc)!== false){
    
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

        if($numColumnas==30){

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
                            $valorCelda  = $hoja->getCellByColumnAndRow($col, $fila)->getValue();
                            $valorCeldaF = ($valorCelda!='') ? $valorCelda : 0.00;
                            $datos[$valorCeldaIndex][$valorCeldaIndexDos] .= $valorCeldaF . ',';
                        }
                    }
                }
            }

            $_SESSION['datos'] = $datos;

            $BTBPPTOF = db_select("SELECT * FROM tb_mkt_presupuesto_det WHERe ID_presupuesto=" . $keypptoExcel . " ");
            

            foreach ($BTBPPTOF as $key) {
                $BTBEPIGRA = db_select("SELECT * FROM tb_mkt_epigrafes WHERe ID=" . $key['ID_epigrafe'] . " ");

                $DATOS = explode(',', trim($datos[$BTBEPIGRA[0]['cuentajde']][$BTBEPIGRA[0]['clave']]));

                if (!empty($datos[$BTBEPIGRA[0]['cuentajde']][$BTBEPIGRA[0]['clave']])) {
                    $UTBPPTOCAB = db_query("UPDATE tb_mkt_presupuesto_det SET   
                    realene=" . $DATOS[0] . ",
                    pptoene=" . $DATOS[1] . ",
                    realfeb=" . $DATOS[2] . ",
                    pptofeb=" . $DATOS[3] . ",
                    realmar=" . $DATOS[4] . ",
                    pptomar=" . $DATOS[5] . ",
                    realabr=" . $DATOS[6] . ",
                    pptoabr=" . $DATOS[7] . ",
                    realmay=" . $DATOS[8] . ",
                    pptomay=" . $DATOS[9] . ",
                    realjun=" . $DATOS[10] . ",
                    pptojun=" . $DATOS[11] . ",
                    realjul=" . $DATOS[12] . ",
                    pptojul=" . $DATOS[13] . ",
                    realago=" . $DATOS[14] . ",
                    pptoago=" . $DATOS[15] . ",
                    realsep=" . $DATOS[16] . ",
                    pptosep=" . $DATOS[17] . ",
                    realoct=" . $DATOS[18] . ",
                    pptooct=" . $DATOS[19] . ",
                    realnov=" . $DATOS[20] . ",
                    pptonov=" . $DATOS[21] . ",
                    realdic=" . $DATOS[22] . ",
                    pptodic=" . $DATOS[23] . ",
                    estatus=1 WHERE ID_epigrafe=" . $key['ID_epigrafe'] . " AND ID_presupuesto = " . $key['ID_presupuesto'] . "");
                }
            }
            $ar['msj'] = 'Se cargaron los saldos correctamente';
            $ar['alerta'] = 'success';

        
        }else{
            $ar['msj'] = 'Su archivo no contiene el numero de columnas establecidas para realizar la carga, validar por favor.';
            $ar['alerta'] = 'error';
        }

    }else {
        $ar['msj']      = 'No se pudo cargar su archivo correctamente!';
        $ar['alerta']   = 'error';
    }

}else{
    $ar['msj']      = 'El archivo no corresponde al centro de costos seleccionado, validar por favor.';
    $ar['alerta']   = 'error';
}


$dato_json   = json_encode($ar);
echo $dato_json;
