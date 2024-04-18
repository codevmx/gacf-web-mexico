
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

?>