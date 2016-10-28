<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script>
    $(function(e){
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

        } );
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
    });


</script>
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Resultados</h2>
    </div>
    <div class="div_formularios">
        <div class="row">
            <div class="col">
                <label class="label_caja">Seleccione el proceso</label>
            </div>
            <div class="col_2">
                <select name="procesos_ponderacion" id="procesos_ponderacion">
                    <option value="0">Seleccionar</option>
                    <?php
                        foreach ($procesos as $value) {
                            echo '<option value="'.$value['pk_proceso'].'">'.$value['nombre'].'</option>';  
                        }
                    ?>
                </select><br><br>
            </div>
        </div>
        <div class="row">
            <h1>Ponderación por factor</h1><br><br>
        </div> 
        <div class="row" style="width:96%;">
            <div class="col-md-12">
                <table id="tabla_ponderacion_factor" class="display select" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Ponderación</th>
                            <th>Resultado</th>
                            <th>Cumplimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <br><h1>Ponderación por caracteristica</h1><br><br>
        </div> 
        <div class="row" style="width:96%;">
            <div class="col-md-12">
                <table id="tabla_ponderacion_caracteristica" class="display select" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Factor</th>
                            <th>Nombre</th>
                            <th>Ponderación</th>
                            <th>Resultado</th>
                            <th>Cumplimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>