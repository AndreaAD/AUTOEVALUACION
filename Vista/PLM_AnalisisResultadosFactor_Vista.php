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

<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<link rel="stylesheet" href="../Css/PLM_Estilos.css"/> 
<script src="../Js/PLM_Analisis.js" type="text/javascript"></script> 
<script>
    $(function(e){
        $('#tabla_analisis_factor').DataTable(
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
    });

</script>
<div class="bloque una-columna">
	<div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Analísis por factor</h2>
    </div>
    <div class="contenido principal-panel-sub-contenido">
    	<table id="tabla_analisis_factor" class="display compact">
    		<thead>
    			<tr>
                    <th>Factor</th>
                    <th>Nombre</th>
    				<th>Ponderacion porcentual</th>
                    <th>Calificación</th>
                    <th>Porcentaje de cumplimiento</th>
                    <th>Escala cualitativa</th>
                    <th>Seleccionar</th>
    			</tr>
    		</thead>
    	<?php
    		foreach($resultados_tabla as &$resultado){
    			echo '<tr data-rel="'.$resultado['pk_factor'].'">';
                    echo '<td>'.$resultado['factor'].'</td>';
                    echo '<td>'.$resultado['nombre'].'</td>';
	    			echo '<td>'.$resultado['ponderacion_porcentual'].'%</td>';
                    echo '<td>'.$resultado['promedio'].'%</td>';
                    echo '<td>'.$resultado['porcentaje_cumplimiento'].'%</td>';
                    echo '<td>'.$resultado['escala'].'</td>';
                    echo '<td><input type="radio" name="seleccionar_factor"></input></td>';
    			echo '</tr>';
    		}
    	?>
    	</table>
        <div style="text-align:center">
            <input type="hidden" id="id_fact" value="0">
            <input type="button" id="buscar_caracteristicas" value="Buscar caracteristicas">
            <input type="button" id="ver_grafica_factor" value="Ver grafica">
            <a class="boton-normal boton-grande" style=" width: 90px;height: 20px;" target="_blank" href="../Vista/PLM_ReportePdf_Vista.php"><span class="texto-boton">Reporte Pdf</span></a>
            <br><br>
        </div>
    </div>
</div>
