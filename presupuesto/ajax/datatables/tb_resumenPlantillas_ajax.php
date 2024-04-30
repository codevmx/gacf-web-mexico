<?php

include ("../../../conexion/conexion.php");
include ("../../../conexion/conexionODBC.php");
include ("../../../conexion/functions.php");

$arrayCabPPTO = FnCabeceraPPTO('', 'T');


if ($arrayCabPPTO['count'] > 0) {
    $i = 0;
    $sumaPTTO = 0;
    $sumaReal = 0;

    foreach ($arrayCabPPTO['arraytb'] as $key) {
        $i++;

        $arrayDetalle = FnDetallePPTO($key['ID_presupuesto'], 'R');
        if ($arrayDetalle['count'] > 0) {
            foreach ($arrayDetalle['arraytb'] as $keyDet) {
                $sumaPTTO = $keyDet['pptoene'] + $keyDet['pptofeb'] + $keyDet['pptomar'] + $keyDet['pptoabr'] + $keyDet['pptomay'] + $keyDet['pptojun'] + $keyDet['pptojul'] + $keyDet['pptoago'] + $keyDet['pptosep'] + $keyDet['pptooct'] + $keyDet['pptonov'] + $keyDet['pptodic'];
                $sumaReal = $keyDet['realene'] + $keyDet['realfeb'] + $keyDet['realmar'] + $keyDet['realabr'] + $keyDet['realmay'] + $keyDet['realjun'] + $keyDet['realjul'] + $keyDet['realago'] + $keyDet['realsep'] + $keyDet['realoct'] + $keyDet['realnov'] + $keyDet['realdic'];
            }
        } else {
            $sumaPTTO = 0;
            $sumaReal = 0;
        }

        $datosCC = db_selectODBC("SELECT TLCDEE,TLNMEL FROM BIM00F.MLINTB WHERE TLCDTB='02602' AND TLCDEE ='" . $key['centrocostos'] . "' ORDER BY TLNMEL");
        $datosEmpresa = FnEmpresas($key['empresa'], 'C');

        $esatus = "<span class='badge bg-success'>" . $key['estatus'] . "</span>";
        $boton = "<button type='button' class='btn btn-info btn-sm' onclick='FnDetallePTTO(" . $key['ID_presupuesto'] . ")'><i class='bi bi-view-list'></i></button> ";
        $boton .= " <button type='button' class='btn btn-danger btn-sm' onclick='FnEliminarPTTO(" . $key['ID_presupuesto'] . ")'><i class='bi bi-trash'></i></button>";

        $tabla .= '{"contador":"' . $i . '",
            "centrocostos":"' . $datosCC[0]['TLCDEE'] . ' - ' . $datosCC[0]['TLNMEL'] . '",
            "empresa":"' . $datosEmpresa['razon'] . '",
            "anio":"' . $key['anio'] . '",
            "totalppto":" $ ' . number_format($sumaPTTO, 2, '.', ',') . '",
            "totalreal":" $ ' . number_format($sumaReal, 2, '.', ',') . '",
            "estatus":"' . $esatus . '",
            "acciones":"' . $boton . '"},';
    }
}



$tabla = substr($tabla, 0, strlen($tabla) - 1);
echo '{"data":[' . $tabla . ']}';
