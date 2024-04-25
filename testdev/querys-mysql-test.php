<?php
include("../conexion/conexion.php");
include("../conexion/functions.php");

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// $sql 	= "SELECT * FROM tb_usuarios WHERE username='marketingpro'";
// $query 	= db_select($sql);

// echo "<pre>";

// foreach ($query as $key => $value) {
//  	echo $value['username'].'|'.$value['ID_perfil'].'|'.$value['password'].'|'.$value['situacion'].'<br>';
// }

echo "</pre>";

?>