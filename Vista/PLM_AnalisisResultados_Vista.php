<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
<script src="../Js/PLM_Analisis.js" type="text/javascript"></script> 

<script>
    $(function(e){
        $('#tabla_analisis_caracteristicas').DataTable();
    })


</script>

<div class="bloque una-columna">
	<div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Analísis por caracteristica</h2>
    </div>
    <div class="contenido">
    	<table id="tabla_analisis_caracteristicas" class="display compact">
    		<thead>
    			<tr>
                    <th>Factor</th>
                    <th>Caracteristica</th>
                    <th>Ponderacion porcentual</th>
                    <th>Calificación</th>
                    <th>Porcentaje de cumplimiento</th>
                    <th>Escala cualitativa</th>
                    <th>Seleccionar</th>
    			</tr>
    		</thead>
    	<?php
    		foreach($resultados_tabla as &$resultado){
    			echo '<tr data-rel="'.$resultado['caracteristica_id'].'">';
	    			echo '<td>'.$resultado['factor'].'</td>';
	    			echo '<td>'.$resultado['caracteristica'].'</td>';
                    echo '<td>'.$resultado['ponderacion_porcentual'].'%</td>';
                    echo '<td>'.$resultado['promedio'].'%</td>';
                    echo '<td>'.$resultado['porcentaje_cumplimiento'].'%</td>';
                    echo '<td>'.$resultado['escala'].'</td>';
                    echo '<td><input type="radio" name="seleccionar_caracteristica"></input></td>';
    			echo '</tr>';
    		}
    	?>
    	</table>
        <div style="text-align:center">
            <input type="hidden" id="id_carac" value="0">
            <input type="button" value="Agregar Analisis" id="agregar_analisis">
            <input type="button" value="Ver graficas">
            <input type="button" value="Reporte en pdf">
            <input type="button" value="Reporte en excel">
            <input type="button" value="Escala cualitativa">
            <br><br>
        </div>
        <!-- <input type="button" id="guardar_caracteristica_analisis" value="Guardar"> -->
    </div>
</div>
