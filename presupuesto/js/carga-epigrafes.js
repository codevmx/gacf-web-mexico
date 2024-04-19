$(document).ready(function () {

    $('#BtnCargarCSV').click(function () {        
        FnCargarArchivo();
    });
});


function beforeSubmit2() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        /*if( !$('#empS').val()) //check empty input filed
        {
            $("#output2").html("<div class='alert alert-danger'><strong>Error!</strong> Antes de continuar, selecciona una empresa.</div>");
            return false
        }*/

        if (!$('#FileInput2').val()) //check empty input filed
        {
            FnNotificacion("<strong>Error!</strong> Antes de continuar, selecciona un archivo valido.", "error");
            return false
        }

        var fsize2 = $('#FileInput2')[0].files[0].size; //get file size
        var ftype2 = $('#FileInput2')[0].files[0].type; // get file type


        //allow file types 
        switch (ftype2) {
            //case 'text/xml':
            case 'text/csv':
                break;
            default:
                FnNotificacion("<strong>Error!</strong> Ingresar unicamente archivos con extensión CSV!", "error");
                return false
        }

        //Allowed file size is less than 5 MB (1048576)
        if (fsize2 > 5242880) {
            FnNotificacion("<strong>Error!</strong> <b>" + bytesToSize(fsize2) + "</b> Archivo muy grande! <br />El archivo es demasiado grande, debe ser inferior a 5 MB.", "error");
            return false
        }

        $('#BtnCargarCSV').hide(); //hide submit button
        $('#loading-img2').show(); //hide submit button
        $("#output2").html("");
    } else {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        FnNotificacion("<strong>Error!</strong> Actualiza tu navegador, debido a que su navegador actual carece de algunas características nuevas que necesitamos!", "error");
        return false;
    }
}

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
            beforeSubmit2();
        }, success: function (data1) {
            var json1   = eval("(" + data1 + ")");
            msj         = json1.msj;
            alerta      = json1.alerta;
            archivo     = json1.archivo;
            ubicacion   = json1.ubicacion;
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