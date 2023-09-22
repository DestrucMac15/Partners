$(document).ready(function(){

    const ruta = $('body').data('ruta');

    $('#tabla').DataTable({
        responsive: true,
        columnDefs: [
            {"className": "dt-center", "targets": "_all"}
        ],
        language: {
            url: ruta+'assets/js/libraries/datatable-es.json'
        }
    });

});