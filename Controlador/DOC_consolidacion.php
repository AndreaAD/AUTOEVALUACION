<?php
	
require_once('../Modelo/DOC_InstruEval_Modelo.php');
$instancia  = new InstruEval_Modelo;
$procesos =  $instancia->listaProcesosFase4();


require_once("../Vista/DOC_ConsolidacionResultados_Vista.php");

?>