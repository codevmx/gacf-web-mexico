<?php

// include("../conexion/conexion.php");
// include("../conexion/conexionODBC.php");


$ar['msj'] = '';


$ar['msj'] .= ' <tr>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                            <input class="form-control" type="text" min="0" id="valpptoene" name="valpptoene" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptofeb" name="valpptofeb" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptomar" name="valpptomar" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptoabr" name="valpptoabr" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptomay" name="valpptomay" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptojun" name="valpptojun" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptojul" name="valpptojul" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptoago" name="valpptoago" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptosep" name="valpptosep" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptooct" name="valpptooct" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptonov" name="valpptonov" value="" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valpptodic" name="valpptodic" value="" />
                            </div>
                        </div>
                    </td>
                </tr>';
                $ar['msj'] .= '<tr>
                        <td>
                        <div class="mb-3">
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" min="0" id="valTotal" name="valTotal" value="" />
                            </div>
                        </div>
                    </td>
                </tr>';


$dato_json   = json_encode($ar);
echo $dato_json;
