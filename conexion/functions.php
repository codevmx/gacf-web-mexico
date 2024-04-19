
<?php
function FnCTUsuarios($ID,$accion){
    switch ($accion) {
        case 'C':
            $BTBUSERS = "SELECT * FROM users WHERE username = '".$ID."' ORDER BY id_user ASC";
            $RTBUSERS = db_select($BTBUSERS);

            $data['count'] = count($RTBUSERS);

            $RTBUSERS = $RTBUSERS[0];

            $data['id_user']    = trim($RTBUSERS['id_user']);
            $data['username']   = trim($RTBUSERS['username']);
            $data['password']   = trim($RTBUSERS['password']);


            break;
    }

    return $data;
}

function vaciarCarpeta($carpeta) {
    // Verifica si la carpeta existe
    if (!is_dir($carpeta)) {
        return false;
    }
    
    // Escanea la carpeta y obtiene la lista de archivos y subdirectorios
    $archivos = scandir($carpeta);
    
    // Elimina cada archivo en la carpeta
    foreach ($archivos as $archivo) {
        // Ignora los directorios especiales "." y ".."
        if ($archivo != "." && $archivo != "..") {
            $rutaArchivo = $carpeta . DIRECTORY_SEPARATOR . $archivo;
            
            // Verifica si es un archivo y lo elimina
            if (is_file($rutaArchivo)) {
                unlink($rutaArchivo);
            } elseif (is_dir($rutaArchivo)) {
                // Si es un directorio, llamar recursivamente a la función para eliminarlo
                vaciarCarpeta($rutaArchivo);
            }
        }
    }
    
    return true;
}

function FnDatosepigrafe($ID){
    $BTBEPI = "SELECT * FROM tb_mkt_epigrafes WHERE ID=".$ID." ";
    $RTBEPI = db_select($BTBEPI);

    if(count($RTBEPI)>0){
        $datos['cuentatg']  = $RTBEPI[0]['cuentatg'];  
        $datos['cuentajde'] = $RTBEPI[0]['cuentajde'];  
        $datos['epigrafe']  = $RTBEPI[0]['epigrafe'];  
        $datos['clave']     = $RTBEPI[0]['clave'];  
        $datos['desgasto']  = $RTBEPI[0]['desgasto'];  
        $datos['motgasto']  = $RTBEPI[0]['motgasto']; 
    }else{
        $datos['cuentatg']  = ''; 
        $datos['cuentajde'] = ''; 
        $datos['epigrafe']  = ''; 
        $datos['clave']     = ''; 
        $datos['desgasto']  = ''; 
        $datos['motgasto']  = '';
    }


    return $datos;
}

?>