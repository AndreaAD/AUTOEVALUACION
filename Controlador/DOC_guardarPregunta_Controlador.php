<?php
/**
 * En este momento enviamos datos s el modelo DOC_preguntas_modelo.php para gardar los nuevos tipos de  respuesta propios del modulo
 */
session_start();
$idTipoRespuesta=$_REQUEST["tipoRespuesta"];
$textoRespuesta[]=$_REQUEST["textoRespuesta"];
$pondRespuesta[]=$_REQUEST["ponderacion"];
$idProceso=$_SESSION["pk_proceso"];
require_once("../Modelo/DOC_preguntas_modelo.php");
$objPreguntas=new Preguntas();
$res = $objPreguntas->guardarPregunta($idTipoRespuesta,$textoRespuesta,$pondRespuesta,$idProceso);
echo $res;
?>
