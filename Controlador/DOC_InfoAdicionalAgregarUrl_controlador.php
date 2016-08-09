<?php
	/**
	 * en este archivo verificamos si la perdona que ingreso a nuestro modulo tiene el privilegio de crear informacion adicional dependiendeo de la fase en que se encuentra su programa actual
	 */
	//require_once("../Vista/DOC_InfoAdiAgregar_Vista.php");
	error_reporting(0);
	session_start();
	require_once("../Vista/DOC_InfoAdiAgregar_Vista.php");
	//include '../Modelo/DOC_InstruEval_Modelo.php';
	//$instrumento = new InstruEval_Modelo;
	//$dato = ($instrumento->verificarfase($_SESSION['pk_usuario'])->GetRows());

	// if ($_SESSION['pk_fase'] == '3'){
	// 	require_once("../Vista/DOC_InfoAdiAgregar_Vista.php");
	// }else{
	// 	echo "
	// 	<div class='aletra-fase'>
	//     	<p>Este proceso se encuentra fuera de la fase de 'Construcción', no podra crear instrumentos de evaluacion.</p>
	//     </div>";
	// }

?>