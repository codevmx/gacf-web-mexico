$(document).ready(function () {

});

function FnDetallePTTO($keyPTTO) {
    $('#keyPTTO').val($keyPTTO + '-R');
    $('#datatables-importesppto').DataTable().destroy();

    $.ajax({
        data: $("#formElimepig").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/ajax/datosCabeceraPTTO_ajax.php?keyPTTO=" + $keyPTTO,
        beforeSend: function () {
            FnNotificacion('Cargando Datos', 'info');
        },
        success: function (data) {
            window.tablaimportesppto($('#keyPTTO').val());
            var json = eval("(" + data + ")");
            centrocostos = json.centrocostos;
            empresa = json.empresa;
            anio = json.anio;
            $('#centroCostos').html(centrocostos);
            $('#empresa').html(empresa);
            $('#anio').html(anio);
            $('#nameExcel').val(centrocostos.trim() + '_' + empresa.trim() + '_' + anio.trim());
            $("#divTablaResumen").show("slow");
            $('html, body').animate({
                scrollTop: $("#divTablaResumen").offset().top
            }, 2000); // 1000 es la duración de la animación en milisegundos
        }
    });
}

function FnEliminarPTTO($keyPTTO) {
    $.ajax({
        data: $("#formElimepig").serialize(),
        type: "POST",
        dataType: "html",
        url: "/gacf-web-mexico/presupuesto/pgm/eliminarPlantillaPTTO_pgm.php?keyPTTO=" + $keyPTTO,
        success: function (data1) {
            var json1   = eval("(" + data1 + ")");
            msj         = json1.msj;
            alerta      = json1.alerta;
            FnNotificacion(msj, alerta);
            $("#datatables-resumenPlantillas").DataTable().ajax.reload();
        }
    });
}