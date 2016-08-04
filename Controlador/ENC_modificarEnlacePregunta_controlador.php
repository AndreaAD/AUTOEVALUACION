<?php
session_start();
$idProceso=$_SESSION["pk_proceso"];
require_once("../Vista/elementos_vista.php");
require_once("../Modelo/ENC_gruposInteres_modelo.php");
require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Modelo/ENC_respuestas_modelo.php");
$idPregunta=$_REQUEST["idpregunta"];
$objGruposInteres=new GruposInteres();
$objPreguntas=new Preguntas();
$objRespuestas=new Respuestas();
$objComp=new Elementos();
$rsDatosPreg=$objPreguntas->getUnaPregunta($idPregunta);
$rsRespuestas=$objRespuestas->getDatosRespuestas($idPregunta);
$rsGruposPregunta=$objGruposInteres->gruposInteresUnaPregunta($idPregunta,$idProceso);
$rsDatosGrupos=$objGruposInteres->getGruposEncuestasNormales();
require_once("../Vista/ENC_modificarEnlacePregunta_vista.php");
?>