function FnNotificacion(mensaje, tipo) {
    // Configura las opciones de la notificación según el tipo
    var opciones = {
        text: mensaje,
        position: 'top-right', // Posición de la notificación
        hideAfter: 3000, // Tiempo de ocultamiento en milisegundos (3 segundos)
        loaderBg: '#E9EAF8' // Color del fondo de la notificación
    };

    // Muestra la notificación según el tipo especificado
    switch (tipo) {
        case 'success':
            // Notificación de éxito
            opciones.bgColor = '#18bc9c';
            opciones.textColor = '#ffffff';
            $.toast(opciones);
            break;
        case 'error':
            // Notificación de error
            opciones.bgColor = '#e74c3c';
            opciones.textColor = '#ffffff';
            $.toast(opciones);
            break;
        case 'warning':
            // Notificación de advertencia
            opciones.bgColor = '#f39c12';
            opciones.textColor = '#ffffff';
            $.toast(opciones);
            break;
        default:
            // Por defecto, mostrar una notificación informativa
            opciones.bgColor = '#3498db';
            opciones.textColor = '#ffffff';
            $.toast(opciones);
    }
}