
<?php
function FnCTUsuarios($ID,$accion){

    $ID = (strpos(trim($ID),'U-')!== false) ? substr(trim($ID),2,10) : trim($ID);

    switch ($accion) {
        case 'C':
            $BTBUSERS           = "SELECT * FROM tb_usuarios WHERE username = '".$ID."' ORDER BY ID_user ASC";
            $RTBUSERS           = db_select($BTBUSERS);

            $data['count']      = count($RTBUSERS);

            $RTBUSERS           = $RTBUSERS[0];

            $Dperfil            = FnCTPerfil($RTBUSERS['ID_perfil']);
            $data['ID_user']    = trim($RTBUSERS['ID_user']);
            $data['username']   = trim($RTBUSERS['username']);
            $data['password']   = trim($RTBUSERS['password']);
            $data['nombres']    = trim($RTBUSERS['nombres']);
            $data['apellidop']  = trim($RTBUSERS['apellidop']);
            $data['apellidom']  = trim($RTBUSERS['apellidom']);
            $data['nombre_completo']  = trim($RTBUSERS['nombres']).' '.trim($RTBUSERS['apellidop']).' '.trim($RTBUSERS['apellidom']);
            $data['rfc']        = trim($RTBUSERS['rfc']);
            $data['correo']     = trim($RTBUSERS['correo']);
            $data['ID_perfil']  = $RTBUSERS['ID_perfil'];
            $data['perfil']     = $Dperfil['nombre'];
            $data['imgperfil']  = trim($RTBUSERS['imgperfil']);            
            $data['situacion']  = $RTBUSERS['situacion'];
            $data['estatus']    = $RTBUSERS['estatus'];

            break;
    }

    return $data;
}

function FnCTPerfil($ID){
    $RTBNIV             = db_select("SELECT * FROM niveles WHERE id_nivel=".$ID." ORDER BY id_nivel ASC ");
    $data['count']      = count($RTBNIV);

    $RTBUSERS           = $RTBUSERS[0];
    $data['nivel']      = trim($RTBUSERS['nivel']);
    $data['nombre']     = trim($RTBUSERS['nombre']);

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