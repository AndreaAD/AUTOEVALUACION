<?php
	error_reporting(0);
	session_start();

    include '../Modelo/PLM_Plan_Modelo.php';
	$instancia = new Plan;
	$informe = $instancia->informe_analisis($_SESSION['pk_proceso'])->GetRows();

	if(count($informe) > 0){
		if ($_SESSION['pk_fase'] == '6' || $_SESSION['pk_fase'] == '5'){
			require_once("../Vista/PLM_informe_analisis_Vista.php");
		}else{
			echo "
			<div class='aletra-fase'>
		    	<p>El proceso no se encuentra en la fase Plan de mejoramiento</p>
		    </div>";
		}
	}else{
		echo "
		<div class='aletra-fase'>
		    	<p>El proceso actual no ha generado un análisis causal.</p>
		</div>";
	}

		

?>