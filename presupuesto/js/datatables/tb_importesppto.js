// DataTables with Column Search by Text Inputs
document.addEventListener("DOMContentLoaded", function () {

    window.tablaimportesppto = function (datos) {

        console.log(datos);

        if (datos != '') {
            if (!$.fn.DataTable.isDataTable('#datatables-importesppto')) {
                
                // Si DataTables no está aplicado, inicialízalo
                var tables = $("#datatables-importesppto").DataTable({
                    "ajax": {
                        "data": datos,
                        "url": "/gacf-web-mexico/presupuesto/ajax/datatables/tb_importesPPTO_ajax.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "epigrafe" },
                        { "data": "clave" },
                        { "data": "descripciongasto" },
                        { "data": "motivogasto" },
                        { "data": "realenero" },
                        { "data": "pttoenero" },
                        { "data": "realfebrero" },
                        { "data": "pttofebrero" },
                        { "data": "realmarzo" },
                        { "data": "pttomarzo" },
                        { "data": "realabril" },
                        { "data": "pttoabril" },
                        { "data": "realmayo" },
                        { "data": "pttomayo" },
                        { "data": "realjunio" },
                        { "data": "pttojunio" },
                        { "data": "realjulio" },
                        { "data": "pttojulio" },
                        { "data": "realagosto" },
                        { "data": "pttoagosto" },
                        { "data": "realseptiembre" },
                        { "data": "pttoseptiembre" },
                        { "data": "realoctubre" },
                        { "data": "pttooctubre" },
                        { "data": "realnoviembre" },
                        { "data": "pttonoviembre" },
                        { "data": "realdiciembre" },
                        { "data": "pttodiciembre" },
                        { "data": "acciones" },
                    ],
                    scrollX: true, scrollCollapse: true,fixedColumns: {
                        leftColumns : 3
                    },
                    "language": {
                        "lengthMenu": "Mostrar " + "<select class='custom-select custom-select-sm form-control form-control-sm'><option value='10' >10</option><option value='25'>25</option><option value='50'>50</option><option value='100'>100</option><option value='-1'>All</option></select>" + " registros por página",
                        "zeroRecords": "No se encontraron registros.",
                        "info": "Mostrando la página _PAGE_ de _PAGES_",
                        "infoFiltered": "(Fildrado de _MAX_ registros totales)",
                        "search": "Buscar:",
                        "paginate": {
                            'next': "Siguiente",
                            'previous': "Anterior"
                        }
                    }

                });
            } else {
                $("#datatables-importesppto").DataTable().ajax.reload();
            }

        }

    };

});