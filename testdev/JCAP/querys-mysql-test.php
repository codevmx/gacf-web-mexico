<?php
include("../../conexion/conexion.php");


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

$sql 	= "SELECT * FROM users LIMIT 10";
$query 	= db_select($sql);

echo "<pre>";

foreach ($query as $key => $value) {
 	echo $value['username'].'<br>'.$value['nivel'];
}

echo "</pre>";

?>