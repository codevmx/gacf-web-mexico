<?php

include("../../conexion/conexion.php");
include("../../conexion/functions.php");

$Idpassword     = trim($_POST['Idpassword-signin']);
$Idpasswordnew  = trim($_POST['Idpassword-signin-new']);

$username       = $_SESSION['Idusername-updatepwd'];

if($Idpassword==$Idpasswordnew){

    $UTBUSER = "UPDATE tb_usuarios SET password='".md5($Idpassword)."', situacion=0 WHERE username='".$username."'"; //
    $RTBUSER = db_query($UTBUSER);

    unset($_SESSION['Idusername-updatepwd']);

    $ar['band']     = '1';
    $ar['msj'] 		= 'Contraseña actualizada con exito.';
    $ar['alert']	= 'success';

}else{
    $ar['band'] 	= '2';
	$ar['msj'] 		= 'Las contraseñas no coinciden.';
	$ar['alert']	= 'error';
}


$dato_json   = json_encode($ar);
echo $dato_json;

?>