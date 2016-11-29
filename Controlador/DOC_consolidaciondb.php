<?php
session_start();

require_once('../Modelo/DOC_Autoevaluacion_Modelo.php');
$instancia  = new Autoevaluacion_Modelo;

$listaProcesosG =  $instancia->listaProcesosFase5($_SESSION['array_proceso']);
$listaConsolidados =  $instancia->listaConsolidados();
//var_dump($listaProcesosG);
//exit();


//$listaProcesosG =  $instancia->consolidado();


//$lista =  $instancia->listaProcesosFase2($_SESSION['array_proceso']);
//$usuario_alcance =  $instancia->consultaUsuarioAlcance($_SESSION['pk_rol'], $_SESSION['pk_usuario'] );
//$insertar_ins =  $instancia->insertarInstrumentosProceso($_SESSION['array_proceso']);

require_once("../Vista/DOC_ConsolidarInstrumentos_Vista.php");



?>

