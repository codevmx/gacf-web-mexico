<?php
include("../conexion/conexion.php");


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$sql 	= "SELECT * FROM users WHERE username='marketing'";
$query 	= db_select($sql);

echo "<pre>";

foreach ($query as $key => $value) {
 	echo $value['username'].'|'.$value['nivel'].'|'.$value['password'].'<br>';
}

echo "</pre>";

?>