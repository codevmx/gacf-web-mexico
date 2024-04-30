// DataTables with Column Search by Text Inputs
document.addEventListener("DOMContentLoaded", function () {

    var tables = $("#datatables-resumenPlantillas").DataTable({
        "ajax": {
            "url": "/gacf-web-mexico/presupuesto/ajax/datatables/tb_resumenPlantillas_ajax.php",
            "type": "POST"
        },
        "columns": [
            { "data": "contador" },
            { "data": "centrocostos" },
            { "data": "empresa" },
            { "data": "anio" },
            { "data": "totalppto" },
            { "data": "totalreal" },
            { "data": "estatus" },
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

});