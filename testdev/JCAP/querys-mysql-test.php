<?php
include("../../conexion/conexion.php");


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$sql 	= "INSERT INTO tb_mkt_epigrafes (cuentatg,cuentajde,epigrafe,clave,desgasto,motgasto)VALUES('00005','00005','pp','pp','pp','pp')";
$query 	= db_query($sql);

// echo "<pre>";

// foreach ($query as $key => $value) {
//  	echo $value['username'].'<br>'.$value['nivel'];
// }

// echo "</pre>";

?>