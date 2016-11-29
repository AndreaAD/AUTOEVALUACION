<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<link rel="stylesheet" href="../Complementos/font-awesome/css/font-awesome.min.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<!-- <script type="text/javascript" src="../Js/DOC_autoevaluacion.js"></script> -->



<?php

	if(count($listaProcesosG) > 0 ){
		echo '<h4>Los procesos listados a continuación se encuentran en fase de CAPTURA DE DATOS, desea generar los instrumentos de evaluación para estos procesos.</h4>';
		//var_dump($listaProcesosG);
		echo '<ul style="    text-align: left;    line-height: 10px;">';
		foreach ($listaProcesosG as $value) {
			echo '<li><span>'.$value.'</span></li><br>';
		}
		echo '</ul>';
		echo '<input type="button" id="GenerarInstrumentos" value="Generar">';
	}else{
		echo '<h4>En este momento no cuenta con ningun proceso en captura de datos para generar los instrumentos.</h4>';

	}

	if(count($procesosGenerados) > 0 ){
		echo '<h1>Procesos generados</h1>';
		echo '<table>';
			echo '<thead>';
				echo '<th>Proceso</th>';
				echo '<th>Programa</th>';
				echo '<th>Sede</th>';
				echo '<th>Facultad</th>';
				echo '<th>Fecha Inicio</th>';
				echo '<th>Fecha Fin</th>';
			echo '</thead>';
			echo '<tbody>';
			foreach ($procesosGenerados as $proceso) {
				echo '<tr>';
					echo '<td>'.$proceso['nombre'].'</td>';
					echo '<td>'.$proceso['programa'].'</td>';
					echo '<td>'.$proceso['sede'].'</td>';
					echo '<td>'.$proceso['facultad'].'</td>';
					echo '<td>'.$proceso['fecha_inicio'].'</td>';
					echo '<td>'.$proceso['fecha_fin'].'</td>';
				echo '</tr>';
			}
			echo '</tbody>';
		echo '</table>';
		
	}
?>

<div id="div_emergente" class="fondo_emergente">
    <div class="emergente">
        <div data-role="contenido" style="text-align: center;"></div>
        <div data-role="botones"></div>
        <span title="cerrar" data-rol="cerrar"> x </span>
    </div>
</div>