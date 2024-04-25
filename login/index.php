<?php

include("../conexion/conexion.php");
include("../conexion/functions.php");

if (!loggedin()) {
    header("Location: gacf-dashboard");
    exit();
}else{
    // Verificar si la cookie de sesión está presente y es válida
    if (isset($_COOKIE['tk_sesion'])) {
        // La cookie de sesión está presente, puedes hacer cualquier validación adicional aquí
        header("Location: gacf-usuario-pwd");
        exit();
    } else {
        // La cookie de sesión no está presente, redirigir al usuario a la página de inicio de sesión
        header("Location: gacf-sesion-pwd");
        exit();
    }
}


?>