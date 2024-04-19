// DataTables with Column Search by Text Inputs
document.addEventListener("DOMContentLoaded", function () {

    window.tablaimportesppto = function (datos) {

        if (datos != '') {
            var tables = $("#datatables-importesppto").DataTable({
                "ajax": {
                    "data": datos,
                    "url": "/gacf-web-mexico/presupuesto/ajax/datatables/tb_importesPPTO_ajax.php",
                    "type": "POST"
                },
                "columns": [
                    { "data": "linea" },
                    { "data": "cuentajde" },
                    { "data": "epigrafe" },
                    { "data": "clave" },
                    { "data": "descripciongasto" },
                    { "data": "motivogasto" },
                    { "data": "estatus" },
                    { "data": "total" },
                    { "data": "acciones" },
                ],
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
        }

    };

});