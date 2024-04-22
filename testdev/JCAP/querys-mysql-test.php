<?php
include("../../conexion/conexion.php");


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$sql 	= "SELECT * FROM tb_mkt_presupuesto_det WHERE ID_presupuesto = 1";
$query 	= db_select($sql);

echo "<pre>";
//print_r($query[1]['BXCVPR']);
echo 'Numero de registros = ' . count($query);
//echo '<br>En caso de error = ' . db_errorODBC();
//print_r($query);
echo "</pre>";

echo "<pre>#|";
foreach ($query[0] as $key2 => $value2) {
  echo trim($key2) . "|";
}
echo "<br>";
$i = 1;
foreach ($query as $key => $value) {

  echo $i . "|";
  foreach ($value as $key1 => $valor) {
    echo utf8_encode(trim($valor)) . "|";
  }
  $i++;
  echo "<br>";
  flush();
  ob_flush();
}

echo "</pre>";
?>