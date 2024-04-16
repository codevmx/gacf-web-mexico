<?php
$tabla = '';

$tabla .= '{        "linea":"Prueba",
                    "cuentajde":"Prueba",
                    "epigrafe":"Prueba",
                    "clave":"Prueba",
                    "descripciongasto":"Prueba",
                    "motivogasto":"Prueba",
                    "estatus":"Prueba",
                    "total":"Prueba",
                    "acciones":"Prueba"},';

$tabla = substr($tabla, 0, strlen($tabla) - 1);
echo '{"data":[' . $tabla . ']}';
