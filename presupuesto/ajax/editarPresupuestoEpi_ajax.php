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
                            <input class="form-control" type="text" min="0" id="valppto1"  name="valpptoene" value="' . $key['pptoene'] . '" onchange="FnCopiarCampos(1)" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto2" name="valpptofeb" value="' . $key['pptofeb'] . '" onchange="FnCopiarCampos(2)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto3" name="valpptomar" value="' . $key['pptomar'] . '" onchange="FnCopiarCampos(3)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto4" name="valpptoabr" value="' . $key['pptoabr'] . '" onchange="FnCopiarCampos(4)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto5" name="valpptomay" value="' . $key['pptomay'] . '" onchange="FnCopiarCampos(5)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto6" name="valpptojun" value="' . $key['pptojun'] . '" onchange="FnCopiarCampos(6)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto7" name="valpptojul" value="' . $key['pptojul'] . '" onchange="FnCopiarCampos(7)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto8" name="valpptoago" value="' . $key['pptoago'] . '" onchange="FnCopiarCampos(8)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto9" name="valpptosep" value="' . $key['pptosep'] . '" onchange="FnCopiarCampos(9)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto10" name="valpptooct" value="' . $key['pptooct'] . '" onchange="FnCopiarCampos(10)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto11" name="valpptonov" value="' . $key['pptonov'] . '" onchange="FnCopiarCampos(11)"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valppto12" name="valpptodic" value="' . $key['pptodic'] . '" onchange="FnCopiarCampos(12)"/>
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
