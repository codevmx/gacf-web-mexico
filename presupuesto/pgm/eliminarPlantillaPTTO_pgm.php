<?php
include ("../../conexion/conexionODBC.php");
include ("../../conexion/conexion.php");
include ("../../conexion/functions.php");

$keyPTTO = $_GET['keyPTTO'];

$UTBEPICAB = "DELETE FROM tb_mkt_presupuesto_cab WHERE ID_presupuesto = ".$keyPTTO."";
$RTBEPICAB = db_query($UTBEPICAB);

$UTBEPIDET = "DELETE FROM tb_mkt_presupuesto_det WHERE ID_presupuesto = ".$keyPTTO."";
$RTBEPIDET = db_query($UTBEPIDET);

$band = FnCabeceraPPTO($keyPTTO,'C');

if ($band['count']==0) {
    $ar['msj']="<strong>Exito!</strong> Se elimino correctamente la plantilla";
    $ar['alerta']="success";
}else{
    $ar['msj']="<strong>Error!</strong> No se pudo eliminar la platilla correctamente ";
    $ar['alerta']="error";
}

$dato_json = json_encode($ar);
echo $dato_json;
