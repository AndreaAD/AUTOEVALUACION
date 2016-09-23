<?php 
error_reporting(0);
session_start();

require_once('../Controlador/DOC_Autoevaluacion_Controlador.php');
$instancia  = new Autoevaluacion_Controlador;

echo '<div class="bloque una-columna">';
    echo '<div class="titulo-bloque texto-izquierda">';
        echo '<h2 class="icon-quill">Tabla de resultados</h2>';
    echo '</div>';
    echo '<div class="cuerpo-bloque texto-centro">';
		echo '<table>';
		    echo '<th>Proceso</th>';
		    echo '<th>Total Instrumentos</th>';
		    echo '<th>Total Instrumentos Diligenciados</th>';
		echo '</tr>';
		foreach ($_SESSION['array_proceso'] as &$proceso) {
		    $datos =  $instancia->ResultadosProgramaProceso($proceso['pk_proceso']);
		     echo '<tr><td>'.$proceso['nombre_proceso'].'</td><td>'.$datos['instrumentos'].'</td><td>'.$datos['totalPrograma'].'</td></tr>';
		}
		echo '</table>';
	echo '</div>';
echo '</div>';




?>