<?php
session_start();

if (!isset($_SESSION)) {

	ini_set('display_errors', 0); // Liberar para producción
	ini_set('display_startup_errors', 0); // Liberar para producción

	session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0);
	ini_set("session.use_only_cookies", "1");
	ini_set("session.use_trans_sid", "0");
}


function db_connect()
{
	static $connection;
	if (!isset($connection)) {
		$BaseDeDatos = 'cfdi';
		$connection  = new mysqli('10.52.70.61', 'cfdi', 'PikgkOyHVhAp6z7CsOsg', $BaseDeDatos); //remoto

		//$BaseDeDatos = 'db_cfdi';
		//$connection  = new mysqli('localhost', 'adminapl', 'DByuXIN9YVbXhBOALfWh', $BaseDeDatos); //local
	}

	if ($connection->connect_errno) {
		return "error de conexión: " . $connection->connect_error;
	}

	return $connection;
}

function db_query($query)
{
	$mysqli 	= db_connect();
	$result     = $mysqli->query($query);
	$tipoQuery  = explode(" ", $query);

	$insertQuery = $tipoQuery[0];
	if ($insertQuery == 'INSERT') {
		$result = mysqli_insert_id($mysqli);
	}

	return $result;
}

function db_select($query)
{
	$rows   	= array();
	$result 	= db_query($query);

	if ($result === false) {
		return false;
	}

	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}

	return $rows;
}

function loggedin()
{
	if (isset($_SESSION['username'])) //||isset($_COOKIE['username'])
	{
		$loggedin = TRUE;
	} else {
		$loggedin = FALSE;
	}
	return $loggedin;
}

function protect($v){
	$v = htmlentities($v, ENT_QUOTES);
	$v = trim($v);
	return $v;
}


