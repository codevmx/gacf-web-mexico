<?php

include ("../../../conexion/conexion.php");
include ("../../../conexion/conexionODBC.php");
include ("../../../conexion/functions.php");

$tabla  = '';
$idppto = $_POST[0];

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

            $tabla .= '{"linea":"' . $i . '",
                    "cuentajde":"' . $Depigrafe['cuentajde'] . '",
                    "epigrafe":"' . $Depigrafe['epigrafe'] . '",
                    "clave":"' . $Depigrafe['clave'] . '",
                    "descripciongasto":"' . $Depigrafe['desgasto'] . '",
                    "motivogasto":"' . $Depigrafe['motgasto'] . '",
                    "estatus":"' . $Dstatus . '",
                    "total":"' . number_format($total, 2) . '",
                    "acciones":"Prueba"},';
        }
    }
}

$tabla = substr($tabla, 0, strlen($tabla) - 1);
echo '{"data":[' . $tabla . ']}';
