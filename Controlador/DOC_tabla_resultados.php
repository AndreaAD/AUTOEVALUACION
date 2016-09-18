<?php 
error_reporting(0);
session_start();

require_once('../Controlador/DOC_Autoevaluacion_Controlador.php');
$instancia  = new Autoevaluacion_Controlador;
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




?>