<?php

include("../../conexion/conexion.php");
include("../../conexion/functions.php");

$username = trim($_POST['Idusername-signin']);
$password = md5($_POST['Idpassword-signin']);

$Duser    = FnCTUsuarios($username,'C');

if($Duser['count']>0){

	$passworduser = $Duser['password'];
    $perfiluser   = $Duser['nivel'];
	//$situacion 		= $Duser['situacion'];
	//$estatus 		= $Duser['estatususer'];

	//if($estatus==2){
		if($passworduser==$password){	
			//registrar nueva contraseña
				//$_SESSION['userempRN'] = $username;
				//$ar['msj'] = '4';
				
				$_SESSION['Idusername-signin'] 	= $username;
                $_SESSION['Idperfil-signin'] 	= $perfiluser;

				$ar['band'] 	= '1';
				$ar['msj'] 		= 'El usuario y la contraseña son correctos.';
				$ar['alert']	= 'success';

		}else{		
			$ar['band'] 	= '2';	
			$ar['msj'] 		= 'El usuario y/o la contraseña ingresados no coinciden.';
			$ar['alert']	= 'error';
		}

	// }else{
	// 	$ar['msj'] = '5';	
	// }

	

}else{
	$ar['band'] 	= '3';
	$ar['msj'] 		= 'El usuario ingresado no existe.';
	$ar['alert']	= 'error';
}


$dato_json   = json_encode($ar);
echo $dato_json;

?>