<?php

include ("../../../conexion/conexion.php");
include ("../../../conexion/conexionODBC.php");
include ("../../../conexion/functions.php");

$tabla = '';
$idppto = $_POST[0];

$valor   = strpos($idppto, 'R');
$accion  = ($_POST[2]!='') ? 'R':'T';

$_SESSION['post'] = $_POST;
$_SESSION['prueba'] = 'PRUEBA' . $_POST[0];


if ($idppto != '') {
    $BTBPPTOF = FnDetallePPTO($idppto,$accion);
    if ($BTBPPTOF['count'] > 0) {
        $i = 0;
        foreach ($BTBPPTOF['arraytb'] as $key) {
            $i++;
            $total = $key['pptoene'] + $key['pptofeb'] + $key['pptomar'] + $key['pptoabr'] + $key['pptomay'] + $key['pptojun'] + $key['pptojul'] + $key['pptoago'] + $key['pptosep'] + $key['pptooct'] + $key['pptonov'] + $key['pptodic'];
            $Depigrafe = FnDatosepigrafe($key['ID_epigrafe']);
            $Dstatus = ($key['estatus'] == 0) ? 'Pendiente' : 'Confirmado';
            $Dstyle = ($key['estatus'] == 0) ? 'class="warning"' : 'class="success"';
            $boton = ($_POST[2]!='') ?"<span class='badge bg-dark'>Sin Acciones</span>":"<button type='button' class='btn btn-info btn-sm'  data-bs-toggle='modal' data-bs-target='#modalppto' data-id='" . $key['ID'] . "' ><i class='bi bi-table'></i></button>";

            $tabla .= '{"epigrafe":"' . $Depigrafe['epigrafe'] . '",
                        "clave":"' . $Depigrafe['clave'] . '",
                        "descripciongasto":"' . $Depigrafe['desgasto'] . '",
                        "motivogasto":"' . $Depigrafe['motgasto'] . '",
                        "realenero":"' . number_format($key['realene'], 2, '.', ',') . '",
                        "pttoenero":"' . number_format($key['pptoene'], 2, '.', ',') . '",
                        "realfebrero":"' . number_format($key['realfeb'], 2, '.', ',') . '",
                        "pttofebrero":"' . number_format($key['pptofeb'], 2, '.', ',') . '",
                        "realmarzo":"' . number_format($key['realmar'], 2, '.', ',') . '",
                        "pttomarzo":"' . number_format($key['pptomar'], 2, '.', ',') . '",
                        "realabril":"' . number_format($key['realabr'], 2, '.', ',') . '",
                        "pttoabril":"' . number_format($key['pptoabr'], 2, '.', ',') . '",
                        "realmayo":"' . number_format($key['realmay'], 2, '.', ',') . '",
                        "pttomayo":"' . number_format($key['pptomay'], 2, '.', ',') . '",
                        "realjunio":"' . number_format($key['realjun'], 2, '.', ',') . '",
                        "pttojunio":"' . number_format($key['pptojun'], 2, '.', ',') . '",
                        "realjulio":"' . number_format($key['realjul'], 2, '.', ',') . '",
                        "pttojulio":"' . number_format($key['pptojul'], 2, '.', ',') . '",
                        "realagosto":"' . number_format($key['realago'], 2, '.', ',') . '",
                        "pttoagosto":"' . number_format($key['pptoago'], 2, '.', ',') . '",
                        "realseptiembre":"' . number_format($key['realsep'], 2, '.', ',') . '",
                        "pttoseptiembre":"' . number_format($key['pptosep'], 2, '.', ',') . '",
                        "realoctubre":"' . number_format($key['realoct'], 2, '.', ',') . '",
                        "pttooctubre":"' . number_format($key['pptooct'], 2, '.', ',') . '",
                        "realnoviembre":"' . number_format($key['realnov'], 2, '.', ',') . '",
                        "pttonoviembre":"' . number_format($key['pptonov'], 2, '.', ',') . '",
                        "realdiciembre":"' . number_format($key['realdic'], 2, '.', ',') . '",
                        "pttodiciembre":"' . number_format($key['pptodic'], 2, '.', ',') . '",
                        "acciones":"' . $boton . '"},';
        }
    }
}

$tabla = substr($tabla, 0, strlen($tabla) - 1);
echo '{"data":[' . $tabla . ']}';
