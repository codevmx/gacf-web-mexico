<?php

include("../../conexion/conexion.php");
include("../../conexion/conexionODBC.php");

$username           = 'JCAP';//$_SESSION['username'];
$anio               = $_POST['anio'];
$inputCentroC       = $_POST['inputCentroC'];
$inputEmpresa       = $_POST['inputEmpresa'];

$BTBPPTOCAB = db_select("SELECT * FROM tb_mkt_presupuesto_cab WHERE tipo='presini' AND anio='".$anio."' AND empresa='".$inputEmpresa."' AND centrocostos='".$inputCentroC."'");
if(count($BTBPPTOCAB)>0){
    $ITBPPTOCAB = $BTBPPTOCAB[0]['ID_presupuesto'];
}else{

    $ITBPPTOCAB = db_query("INSERT INTO tb_mkt_presupuesto_cab (tipo,anio,periodo,empresa,centrocostos,estatus,usuario_reg,fecha_reg,hora_reg)VALUES('presini','2024','','".$inputEmpresa."','".$inputCentroC."','Creado','".$username."','".date("Y-m-d")."','".date("H:i:s")."')");

    $BTBEPI = "SELECT * FROM tb_mkt_epigrafes ";
    $RTBEPI = db_select($BTBEPI);
    foreach ($RTBEPI as $key) {	
        $ITBPPTODET = db_query("INSERT INTO tb_mkt_presupuesto_det 
                    (ID_presupuesto,ID_epigrafe,pptoene,pptofeb,
                    pptomar,pptoabr,pptomay,pptojun,pptojul,
                    pptoago,pptosep,pptooct,pptonov,pptodic,
                    estatus)VALUES(".$ITBPPTOCAB.",".$key['ID'].",0,0,
                    0,0,0,0,0,0,0,0,0,0,0) ");
    }
}


$BTBPPTO = db_select("SELECT * FROM tb_mkt_presupuesto_det WHERE ID_presupuesto = ".$ITBPPTOCAB." ");
if(count($BTBPPTO)>0){
    $ar['msj']      = 'exito';
    $ar['idppto']   = $ITBPPTOCAB;
}else{
    $ar['msj']      = 'error';
    $ar['idppto']   = 0;
}

$dato_json   = json_encode($ar);
echo $dato_json;


?>