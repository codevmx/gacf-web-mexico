<?php

include ("../../../conexion/conexion.php");
include ("../../../conexion/conexionODBC.php");

$acc = $_GET['accion'];

if ($acc == 'crear') {
    $inputCuenta = explode('-', $_POST['inputCuenta']);
    $inputEpig = $_POST['inputEpig'];
    $inputClave = $_POST['inputClave'];
    $inputDesGasto = $_POST['inputDesGasto'];
    $inputMotGasto = $_POST['inputMotGasto'];

    $ITBEPI = "INSERT INTO tb_mkt_epigrafes (cuentatg,cuentajde,epigrafe,clave,desgasto,motgasto)VALUES('" . $inputCuenta[0] . "','" . $inputCuenta[1] . "','" . $inputEpig . "','" . $inputClave . "','" . $inputDesGasto . "','" . $inputMotGasto . "')";
    $RTBEPI = db_query($ITBEPI);

    if ($RTBEPI) {

        $ar['msj'] = '<strong>Correcto!</strong> Se ha creado el registro exitosamente.';
        $ar['alerta'] = 'success';

    } else {
        $ar['msj'] = '<strong>Error!</strong> Problemas al guardar los datos.';
        $ar['alerta'] = 'error';
    }

} elseif ($acc == 'eliminar') {

    $keyepig = $_POST['keyepig'];
    $UTBEPI = "DELETE FROM tb_mkt_epigrafes WHERE ID=" . $keyepig . " ";
    $RTBEPI = db_query($UTBEPI);

    if ($RTBEPI) {

        $ar['msj'] = '<strong>Correcto!</strong> Se ha eliminado el registro exitosamente.';
        $ar['alerta'] = 'success';

    } else {

        $ar['msj'] = '<strong>Error!</strong> Problemas al guardar los datos.';
        $ar['alerta'] = 'error';
    }
}


$dato_json = json_encode($ar);
echo $dato_json;


?>