<?php

include("../../conexion/conexion.php");
include("../../conexion/functions.php");

$username = trim($_POST['IdusernameR-signin']);
$Duser    = FnCTUsuarios($username,'C');

if($Duser['count']>0){   

    $keyg = bin2hex(random_bytes(32));
    $keyn = md5($keyg);

    $UTBUSER = "UPDATE tb_usuarios SET password='".$keyn."', situacion=1 WHERE username='".$username."'"; //
    $RTBUSER = db_query($UTBUSER);

    $_SESSION['keyn'] = $keyn;
    //if($envioemail['rest']==0){
        $ar['band']     = '1';
        $ar['msj'] 		= 'Solicitud enviada con exito.';
        $ar['alert']	= 'success';
    /*}else{
        $ar['msj']      = '1';
        $ar['msj'] 		= 'Tuvimos problemas para enviar su correo, inténtelo más tarde.';
	    $ar['alert']	= 'error';
    }  */

}else{
	$ar['band'] 	= '3';
	$ar['msj'] 		= 'El usuario ingresado no existe.';
	$ar['alert']	= 'error';
}

$dato_json   = json_encode($ar);
echo $dato_json;

?>