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
				$ar['msj'] 						= '1';
				$_SESSION['Idusername-signin'] 	= $username;
                $_SESSION['Idperfil-signin'] 	= $perfiluser;

		}else{		
			$ar['msj'] = '2';	
		}

	// }else{
	// 	$ar['msj'] = '5';	
	// }

	

}else{
	$ar['msj'] = '3';
	
}


$dato_json   = json_encode($ar);
echo $dato_json;

?>