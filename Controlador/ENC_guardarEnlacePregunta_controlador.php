<?php
session_start();
$idProceso=$_SESSION["pk_proceso"];
$idEvidencia=$_SESSION["enc_idevidencia"];
$idGruposInteres[]=$_REQUEST["gruposInteres"];
$idPregunta=$_REQUEST["idPregunta"];
require_once("../Modelo/ENC_preguntas_modelo.php");
$objPreguntas=new Preguntas();
$objPreguntas->guardarEnlaceUnaPregunta($idPregunta,$idGruposInteres,$idEvidencia,$idProceso);

require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_guardarEnlacePregunta_vista.php");
?>