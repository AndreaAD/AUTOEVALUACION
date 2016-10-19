<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
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
    				<th>Ponderacion modulo documental</th>
    				<th>Ponderacion modulo encuestas</th>
    				<th>Ponderacion final</th>
                    <th>Fortaleza</th>
                    <th>Debilidad</th>
                    <th>Analisis</th>
    			</tr>
    		</thead>
    	<?php
    		foreach($resultados_tabla as &$resultado){
    			echo '<tr data-rel="'.$resultado['caracteristica_id'].'">';
	    			echo '<td>'.$resultado['factor'].'</td>';
	    			echo '<td>'.$resultado['caracteristica'].'</td>';
	    			echo '<td>'.$resultado['valor_modulo_5'].'</td>';
	    			echo '<td>'.$resultado['valor_modulo_6'].'</td>';
	    			echo '<td>'.$resultado['promedio'].'</td>';
                    echo '<td><textarea name="fortaleza"></textarea></td>';
                    echo '<td><textarea name="debilidad"></textarea></td>';
                    echo '<td><textarea name="analisis"></textarea></td>';
    			echo '</tr>';
    		}
    	?>
    	</table>
        <br>
        <input type="button" id="guardar_caracteristica_analisis" value="Guardar">
    </div>
</div>
