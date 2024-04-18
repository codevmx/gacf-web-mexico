<?php
//include("../conexion/conexion.php");


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// $sql 	= "SELECT * FROM users LIMIT 10";
// $query 	= db_select($sql);


// echo "<pre>";
// //print_r($query[1]['BXCVPR']);
// echo 'Numero de registros = '.count($query);
// echo '<br>En caso de error = '.db_error();
// //print_r($query);
// echo "</pre>";

// foreach ($query as $key => $value) {
// 	echo $value['username'].'<br>';
// }

// echo "</pre>";
echo db_connect();

function db_connect() {

	static $connection;
	if (!isset($connection)) {
		//$config = parse_ini_file('config.ini'); 
		$BaseDeDatos = 'db_cfdi';
		$connection  = new mysqli('localhost', 'adminapl', 'DByuXIN9YVbXhBOALfWh', $BaseDeDatos);

		/*$BaseDeDatos = 'cfdi';
		$connection  = new mysqli('10.52.70.61', 'cfdi', 'PikgkOyHVhAp6z7CsOsg', $BaseDeDatos);*/

	}

    if ($connection->connect_errno) {
        return "error de conexión: " . $connection->connect_error;
    }

	return $connection;

}


?>