$(function(e){
    
    $.ajax({
    url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
    type:  'post',
    async: false,
    dataType:'json',
    data:{
        operacion: "Consolidado",
        opcion: 'ResultadosIndex',
    },
    success:  function (data) {
        console.dir(data);
        if(data){
            var tabla_factor = $('#tabla_ponderacion_factor tbody');
            var tabla_carac = $('#tabla_ponderacion_caracteristica tbody');
            var html_tabla_1 = '';
            var html_tabla_2 = '';


            $.each(data[0], function(i, e){
                //console.log(data[1]);
                //$.each(e, function(i1, e1){
                    //console.log(e);
                    html_tabla_1 += '<tr>';
                        html_tabla_1 += '<td>'+e.codigo+'</td>';
                        html_tabla_1 += '<td>'+e.nombre+'</td>';
                        html_tabla_1 += '<td>'+e.valor_factor+'%</td>';
                        html_tabla_1 += '<td>'+e.total_+'%</td>';
                        html_tabla_1 += '<td>'+e.cumplimiento+'%</td>';
                    html_tabla_1 += '</tr>';
                //});
            });

            tabla_factor.html(html_tabla_1);

            $.each(data[1], function(i, e){
                //console.log(data[1]);
                //$.each(e, function(i1, e1){
                    //console.log(e);
                    html_tabla_2 += '<tr>';
                        html_tabla_2 += '<td>'+e.codigo+'</td>';
                        html_tabla_2 += '<td>'+e.factor_nombre+'</td>';
                        html_tabla_2 += '<td>'+e.nombre+'</td>';
                        html_tabla_2 += '<td>'+e.valor_carac+'%</td>';
                        html_tabla_2 += '<td>'+e.valor_ponderado_caracteristica2+'%</td>';
                        html_tabla_2 += '<td>'+e.cumplimiento+'%</td>';
                    html_tabla_2 += '</tr>';
                //});
            });

            tabla_carac.html(html_tabla_2);


            if ( $.fn.dataTable.isDataTable('#tabla_ponderacion_factor') ) {
                    table = $('#tabla_ponderacion_factor').DataTable();
            }
            else{

                $('#tabla_ponderacion_factor').DataTable({
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]

                });
            }

            if ( $.fn.dataTable.isDataTable('#tabla_ponderacion_caracteristica') ) {
                    table = $('#tabla_ponderacion_caracteristica').DataTable();
            }
            else{


            $('#tabla_ponderacion_caracteristica').DataTable({
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]

                } );
            }
        }


    }
   
}); 
});