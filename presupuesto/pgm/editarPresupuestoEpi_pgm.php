<?php

include("../../conexion/conexion.php");
include("../../conexion/conexionODBC.php");

$keyepig    = $_POST['keyepig'];
$valpptoene = $_POST['valpptoene'];
$valpptofeb = $_POST['valpptofeb'];
$valpptomar = $_POST['valpptomar'];
$valpptoabr = $_POST['valpptoabr'];
$valpptomay = $_POST['valpptomay'];
$valpptojun = $_POST['valpptojun'];
$valpptojul = $_POST['valpptojul'];
$valpptoago = $_POST['valpptoago'];
$valpptosep = $_POST['valpptosep'];
$valpptooct = $_POST['valpptooct'];
$valpptonov = $_POST['valpptonov'];
$valpptodic = $_POST['valpptodic'];

$_SESSION['valores'] = $_POST;

$UTBPPTOCAB = db_query("UPDATE tb_mkt_presupuesto_det SET pptoene=".$valpptoene.",
pptofeb=".$valpptofeb.",
pptomar=".$valpptomar.",
pptoabr=".$valpptoabr.",
pptomay=".$valpptomay.",
pptojun=".$valpptojun.",
pptojul=".$valpptojul.",
pptoago=".$valpptoago.",
pptosep=".$valpptosep.",
pptooct=".$valpptooct.",
pptonov=".$valpptonov.",
pptodic=".$valpptodic.",
estatus=1 WHERE ID=".$keyepig."");

if ($UTBPPTOCAB) {
    $ar['msj'] = '<strong>Exito!</strong> Se actualizo correctamente los importes';
    $ar['alerta'] = 'success';
    $ar['band'] = 1;
}else{
    $ar['msj'] = '<strong>Error!</strong> No se pudo actualizar correctamente los importes';
    $ar['alerta'] = 'error';
    $ar['band'] = 0;
}


$dato_json   = json_encode($ar);
echo $dato_json;