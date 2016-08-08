<?php
	/**
	 * en este archivo verificamos si el usuario que ingreso a nuestro modulo tiene el privilegio de crear instrumentos dependiendeo de la fase en que se encuentra su programa actual
	 */
	//require_once("../Vista/DOC_InstruEvalAgregar_Vista.php");
	error_reporting(0);
	session_start();
	//include '../Modelo/DOC_InstruEval_Modelo.php';
	require_once("../Vista/DOC_InstruEvalAgregar_Vista.php");
	//$instrumento = new InstruEval_Modelo;
	//$dato = ($instrumento->verificarfase($_SESSION['pk_usuario'], )->GetRows());

	// if ($_SESSION['pk_fase'] == '3'){
	// 	require_once("../Vista/DOC_InstruEvalAgregar_Vista.php");
	// }else{
	// 	echo "
	// 	<div class='aletra-fase'>
	//     	<p>Este proceso se encuentra fuera de la fase de 'Construcción', no podra crear instrumentos de evaluacion.</p>
	//     </div>";
	// }

?>