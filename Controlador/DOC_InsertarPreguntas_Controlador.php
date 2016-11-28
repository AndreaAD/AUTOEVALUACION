<?php
session_start();

require_once('../Modelo/DOC_Autoevaluacion_Modelo.php');
$instancia  = new Autoevaluacion_Modelo;

$listaProcesosG =  $instancia->listaProcesosFase($_SESSION['array_proceso']);

//$procesosGenerados =  $instancia->procesosGenerados();
//$lista =  $instancia->listaProcesosFase2($_SESSION['array_proceso']);
//$usuario_alcance =  $instancia->consultaUsuarioAlcance($_SESSION['pk_rol'], $_SESSION['pk_usuario'] );
//$insertar_ins =  $instancia->insertarInstrumentosProceso($_SESSION['array_proceso']);

require_once("../Vista/DOC_GenerarInstrumentos_Vista.php");
?>