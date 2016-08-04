<?php
	/**
	 * en este archivo verificamos si la perdona que ingreso a nuestro modulo tiene el privilegio de crear informacion adicional dependiendeo de la fase en que se encuentra su programa actual
	 */
	require_once("../Vista/DOC_InfoAdiAgregar_Vista.php");
	error_reporting(0);
	session_start();
	include '../Modelo/DOC_InstruEval_Modelo.php';
	$instrumento = new InstruEval_Modelo;
	$dato = ($instrumento->verificarfase($_SESSION['pk_usuario'])->GetRows());
	/*if ($dato[0] == '3'){
		require_once("../Vista/DOC_InstruEvalAgregar_Vista.php");
	}else{
		echo "<h3>No se encuentra en la fase de captura de datos</h3>";
	}*/
?>