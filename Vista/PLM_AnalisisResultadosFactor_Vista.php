<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script>
    $(function(e){
        $('#tabla_analisis_factor').DataTable();
    });

</script>
<div class="bloque una-columna">
	<div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Analísis por factor</h2>
    </div>
    <div class="contenido">
    	<table id="tabla_analisis_factor">
    		<thead>
    			<tr>
    				<th>Factor</th>
    				<th>Ponderacion modulo documental</th>
    				<th>Ponderacion modulo encuestas</th>
                    <th>Ponderacion final</th>
    			</tr>
    		</thead>
    	<?php
    		foreach($resultados_tabla as &$resultado){
    			echo '<tr>';
	    			echo '<td>'.$resultado['factor'].'</td>';
	    			echo '<td>'.$resultado['valor_modulo_5'].'</td>';
	    			echo '<td>'.$resultado['valor_modulo_6'].'</td>';
                    echo '<td>'.$resultado['promedio'].'</td>';
    			echo '</tr>';
    		}
    	?>
    	</table>
    </div>
</div>
