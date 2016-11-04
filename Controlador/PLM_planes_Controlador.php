<?php
	/**
	 * en este archivo verificamos si el usuario que ingreso a nuestro modulo tiene el privilegio de crear instrumentos dependiendeo de la fase en que se encuentra su programa actual
	 */
	//require_once("../Vista/DOC_InstruEvalAgregar_Vista.php");
	error_reporting(0);
	session_start();

    include '../Modelo/PLM_Plan_Modelo.php';
	$plan = new Plan;
	$factores = $plan->buscarFactores()->GetRows();


	$proceso = $_SESSION['nombre_proceso'];
	$id_proceso = $_SESSION['pk_proceso'];


	if ($_SESSION['pk_fase'] == '6'){
		require_once("../Vista/PLM_planes_Vista.php");
	}else{
		echo "
		<div class='aletra-fase'>
	    	<p>Este proceso se encuentra fuera de la fase de 'Plan de mejoramiento'.</p>
	    </div>";
	}

?>