<?php

include("../../../conexion/conexion.php");
include("../../../conexion/conexionODBC.php");

$BTBEPI = "SELECT * FROM tb_mkt_epigrafes ";
$RTBEPI = db_select($BTBEPI);

$tabla = '';

if (count($RTBEPI)>0) {
    $i=0;
    foreach ($RTBEPI as $key) {
        $i++;
        $boton = "<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#eliminarEPGF' data-id='".$key['ID']."' ><i class='bi bi-trash'></i></button>";
        $tabla .= '{
            "linea":"'.$i.'",
            "cuentajde":"'.$key['cuentajde'].'",
            "epigrafe":"'.utf8_encode($key['epigrafe']).'",
            "clave":"'.$key['clave'].'",
            "descripciongasto":"'.utf8_encode($key['desgasto']).'",
            "motivogasto":"'.utf8_encode($key['motgasto']).'",
            "acciones":"'.$boton.'"},';
    }
}

$tabla = substr($tabla, 0, strlen($tabla) - 1);
echo '{"data":[' . $tabla . ']}';
