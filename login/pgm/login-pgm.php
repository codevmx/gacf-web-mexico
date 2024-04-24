<?php

include("../../conexion/conexion.php");
include("../../conexion/functions.php");

$expuser = explode('-',trim($_POST['Idusername-signin']));

if(strpos(trim($_POST['Idusername-signin']),'U-')!== false){
	$username = $expuser[1];
}else{
	$username = trim($_POST['Idusername-signin']);
}

$password = protect(htmlentities($_POST['Idpassword-signin'])); //md5($_POST['Idpassword-signin']);

$Duser    = FnCTUsuarios($username,'C');

if($Duser['count']>0){

	$passworduser = $Duser['password'];
    $perfiluser   = $Duser['perfil'];
	$situacion 	  = $Duser['situacion'];
	//$estatus 		= $Duser['estatususer'];	
	
	if($situacion==0){
		if($passworduser==md5($password)){	
			
				if (isset($_POST['checkbox-signin'])) {

					if (isset($_COOKIE['tk_sesion'])) {
						// Establece la cookie con el mismo nombre pero sin valor y en una fecha de expiración pasada
						setcookie('tk_sesion', '', time() - 3600, '/');
					}

					$token = bin2hex(random_bytes(32));
					// Establecer la cookie con el identificador de sesión
					setcookie("tk_sesion", $token, time() + (86400 * 30), "/");
					setcookie("utk_sesion", 'U-'.$username, time() + (86400 * 30), "/");

				}
				
				$_SESSION['Idusername-signin'] 	= $username;
                $_SESSION['Idperfil-signin'] 	= $perfiluser;

				$ar['band'] 	= '1';
				$ar['msj'] 		= 'Acceso exitoso!';
				$ar['alert']	= 'success';

		}else{		
			$ar['band'] 	= '2';	
			$ar['msj'] 		= 'El usuario y/o la contraseña sin incorrectos.';
			$ar['alert']	= 'error';
		}	

	}else{
		if($passworduser==$password){

			$_SESSION['Idusername-updatepwd'] 	= $username;
			$ar['band'] 	= '4';
			$ar['msj'] 		= 'Acceso exitoso!';
			$ar['alert']	= 'success';
		}else{
			$ar['band'] 	= '2';	
			$ar['msj'] 		= 'El usuario y/o la contraseña sin incorrectos.';
			$ar['alert']	= 'error';
		}
	}
}else{
	$ar['band'] 	= '3';
	$ar['msj'] 		= 'El usuario ingresado no existe.';
	$ar['alert']	= 'error';
}


$dato_json   = json_encode($ar);
echo $dato_json;

?>