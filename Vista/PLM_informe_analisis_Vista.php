<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/Buttons/js/dataTables.buttons.js"></script>
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/extensions/Buttons/css/buttons.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/Buttons/js/buttons.html5.js"></script>

<link rel="stylesheet" type="text/css" href="../Css/PLM_Estilos.css">
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<link rel="stylesheet" href="../Complementos/font-awesome/css/font-awesome.min.css">
<!-- 
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_Instrueval.js"></script> --> 
<script>
$('#tabla_analisis').DataTable(
            {
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

        }
        );
</script>
<div id="div_formulario_principal">
    <div class="bloque una-columna">
        <div class="titulo-bloque texto-izquierda">
            <h2 class="icon-quill">Informe análisis causal</h2>
        </div>
        <div>    
            <div class="row">
                <br><br>
            </div> 
            <div class="row tabla_ins" style="width:96%;">
                <div class="col-md-12">
                    <table id="tabla_analisis">
                        <thead>
                            <th>Factor</th>
                            <th>Caracteristica</th>
                            <th>Ponderación</th>
                            <th>Calificacíon</th>
                            <th>Analisis</th>
                            <th>fortaleza</th>
                            <th>Debilidad</th>
                        </thead>
                        <tbody>
                            <?php foreach ($informe as &$item): ?>
                                <tr>
                                    <td><?php echo $item['factor']; ?></td>
                                    <td><?php echo $item['caracteristica']; ?></td>
                                    <td><?php echo $item['ponderacion']; ?></td>
                                    <td><?php echo $item['calificacion']; ?></td>
                                    <td><?php echo $item['analisis']; ?></td>
                                    <td><?php echo $item['fortaleza']; ?></td>
                                    <td><?php echo $item['debilidad']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="formulario_secundario"></div>
<div class="errores"></div>
    <div id="div_emergente" class="fondo_emergente">
        <div class="emergente">
            <div data-role="contenido" style="text-align:center;"></div>
            <div data-role="botones"></div>
            <span title="cerrar" data-rol="cerrar"> x </span>
        </div>
    </div>
</div>