<?php
	error_reporting(0);
	session_start();

    include '../Modelo/PLM_Plan_Modelo.php';
	$instancia = new Plan;
	
	$sedes = $instancia->lista_sedes()->GetRows();
	$facultades = $instancia->lista_facultades()->GetRows();
	require_once("../Vista/PLM_planes_historico_Vista.php");


?>