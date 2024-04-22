$(document).ready(function () {

    $('#BtnCargarCSV').click(function () {        
        FnCargarArchivo();
    });
});

function FnCargarArchivo() {
    var datas = new FormData($("#cargarArchCSV")[0]);
    $.ajax({
        data: datas,
        type: "POST",
        dataType: "html",
        contentType: false,
        processData: false,
        url: "/gacf-web-mexico/presupuesto/ajax/importarEpigrafes_ajax.php",
        beforeSend: function () {
            $("#barProgresspas").fadeIn();
            $("#barProgresspas").html('<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%">Cargando ....</div>');
        }, success: function (data1) {
            var json1   = eval("(" + data1 + ")");
            msj         = json1.msj;
            alerta      = json1.alerta;
            archivo     = json1.archivo;
            ubicacion   = json1.ubicacion;

            $("#barProgresspas").fadeOut();
            $("#barProgresspas").html('');
            $('#BtnCargarCSV').show(); //hide submit button
            $('#loading-img2').hide(); //hide submit button
            FnNotificacion(msj, alerta);
            $("#datatables-epigrafes").DataTable().ajax.reload();
            $('#FileInput2').val('');
            $("#Divtable-epigrafes").fadeIn();
            // $("#DivMsj").empty('');
            // $("#DivMsj").append(msj1);
        }
    })
}