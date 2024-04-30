<?php
include ("../../conexion/conexionODBC.php");
include ("../../conexion/conexion.php");
include ("../../conexion/functions.php");

$keyPTTO = $_GET['keyPTTO'];

$arrayCabPPTO   = FnCabeceraPPTO($keyPTTO,'C');
$datosCC        = db_selectODBC("SELECT TLCDEE,TLNMEL FROM BIM00F.MLINTB WHERE TLCDTB='02602' AND TLCDEE ='".$arrayCabPPTO['cc']."' ORDER BY TLNMEL");
$datosEmpresa   = FnEmpresas($arrayCabPPTO['empresa'],'C');

$ar['centrocostos'] = $datosCC[0]['TLCDEE'] . ' - '.$datosCC[0]['TLNMEL'];
$ar['anio']         = $arrayCabPPTO['anio'];
$ar['empresa']      = $datosEmpresa['razon'];

$dato_json = json_encode($ar);
echo $dato_json;
