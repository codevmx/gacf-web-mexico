<?php

include("../../conexion/conexion.php");
include("../../conexion/conexionODBC.php");

$idepi = $_GET['epi'];

$BTBPPTOF = db_select("SELECT * FROM tb_mkt_presupuesto_det WHERe ID=" . $idepi . " ");

$ar['msj'] = '';
$i = 0;
$total = 0;

foreach ($BTBPPTOF as $key) {
    $i++;
    $ar['msj'] .= ' <tr>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                            <input class="form-control" type="text" min="0" id="valpptoene" name="valpptoene" value="' . $key['pptoene'] . '" onchange="FnSumaCampos()" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptofeb" name="valpptofeb" value="' . $key['pptofeb'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptomar" name="valpptomar" value="' . $key['pptomar'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptoabr" name="valpptoabr" value="' . $key['pptoabr'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptomay" name="valpptomay" value="' . $key['pptomay'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptojun" name="valpptojun" value="' . $key['pptojun'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptojul" name="valpptojul" value="' . $key['pptojul'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptoago" name="valpptoago" value="' . $key['pptoago'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptosep" name="valpptosep" value="' . $key['pptosep'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptooct" name="valpptooct" value="' . $key['pptooct'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptonov" name="valpptonov" value="' . $key['pptonov'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptodic" name="valpptodic" value="' . $key['pptodic'] . '" onchange="FnSumaCampos()"/>
                            </div>
                        </div>
                    </td>
                </tr>';
                $total = $key['pptoene'] + $key['pptofeb'] + $key['pptomar'] + $key['pptoabr'] + $key['pptomay'] + $key['pptojun'] + $key['pptojul'] + $key['pptoago'] + $key['pptosep'] + $key['pptooct'] + $key['pptonov'] + $key['pptodic'];
}



                $ar['msj'] .= '<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                        <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valTotal" name="valTotal" value="' . number_format($total, 2) . '" readonly/>
                            </div>
                        </div>
                    </td>
                </tr>';


$dato_json   = json_encode($ar);
echo $dato_json;
