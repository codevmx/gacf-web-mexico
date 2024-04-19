<?php

include ("../../../conexion/conexion.php");
include ("../../../conexion/conexionODBC.php");
include ("../../../conexion/functions.php");

$tabla  = '';
$idppto = 1;

if ($idppto != '') {
    $BTBPPTOF = "SELECT * FROM tb_mkt_presupuesto_det WHERE ID_presupuesto = " . $idppto . " ";
    $RTBPPTOF = db_select($BTBPPTOF);
    $NTBPPTOF = count($RTBPPTOF);
    $_SESSION['sqlmkt'] = $BTBPPTOF;

    

    if ($NTBPPTOF > 0) {
        $i = 0;
        foreach ($RTBPPTOF as $key) {
            $i++;
            $total = $key['pptoene'] + $key['pptofeb'] + $key['pptomar'] + $key['pptoabr'] + $key['pptomay'] + $key['pptojun'] + $key['pptojul'] + $key['pptoago'] + $key['pptosep'] + $key['pptooct'] + $key['pptonov'] + $key['pptodic'];
            $Depigrafe = FnDatosepigrafe($key['ID_epigrafe']);
            $Dstatus = ($key['estatus'] == 0) ? 'Pendiente' : 'Confirmado';
            $Dstyle = ($key['estatus'] == 0) ? 'class="warning"' : 'class="success"';
            $boton = "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalppto' data-id='".$key['ID']."' ><i class='glyphicon glyphicon-th'></i></button>";

            $tabla .= '{"epigrafe":"' . $Depigrafe['epigrafe'] . '",
                        "clave":"' . $Depigrafe['clave'] . '",
                        "descripciongasto":"' . $Depigrafe['desgasto'] . '",
                        "motivogasto":"' . $Depigrafe['motgasto'] . '",
                        "enero":"0",
                        "febrero":"0",
                        "marzo":"0",
                        "abril":"0",
                        "mayo":"0",
                        "junio":"0",
                        "julio":"0",
                        "agosto":"0",
                        "septiembre":"0",
                        "octubre":"0",
                        "noviembre":"0",
                        "diciembre":"0"},';
        }
    }
}

$tabla = substr($tabla, 0, strlen($tabla) - 1);
echo '{"data":[' . $tabla . ']}';
