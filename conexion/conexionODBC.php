<?php

$bim00f    = 'BIM00F'; // BIM00T PISA
$bim01f    = 'BIM01F'; // BIM01T LOCAL
$cgdata    = 'BTMEXF';
$bimCompr  = 'BIM01F';

/*$bim00f    = 'BIM00F'; //bpicol
$bim01f    = 'BIM01F'; //bpilcol
$btmexf    = 'BTMEXF'; //cgdata
$bim00d    = 'BIM00D';*/


function db_connectODBC() {

    static $connection;

    if(!isset($connection)) {
        $config = parse_ini_file('configODBCv2.ini'); 
        $connection = odbc_connect($config['dsnname'],$config['username'],$config['password']);
    }

	if ($connection==FALSE){ $connection = '1'; }
    return $connection;
}

function db_queryODBC($query) {
    $connection = db_connectODBC();
    $result     = odbc_exec($connection,$query);
    return $result;
}

function db_selectODBC($query) {
    $rows   = array();
    $result = db_queryODBC($query);

    if($result === false) {
        return false;
    }

    while ($row = odbc_fetch_array ($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function db_errorODBC() {
    $connection = db_connectODBC();
    return odbc_errormsg($connection);
}

