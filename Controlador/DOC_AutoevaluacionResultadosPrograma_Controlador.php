<?php
	
require_once('../Modelo/DOC_InstruEval_Modelo.php');
$instancia  = new InstruEval_Modelo;
$procesos =  $instancia->listaProcesos();


require_once("../Vista/DOC_AutoevaluacionResultadosPrograma_Vista.php");


?>