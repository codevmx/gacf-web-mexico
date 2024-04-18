
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

?>