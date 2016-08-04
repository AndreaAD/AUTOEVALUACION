<?php
session_start();
$idGruposInteres=array();
$institucional=0;
if(isset($_REQUEST["institucional"])){
    $institucional=$_REQUEST["institucional"];
    if(isset($_REQUEST["gruposInteres"])){
        $idGruposInteres[]=$_REQUEST["gruposInteres"];
    }
}
$idPregunta=$_REQUEST["idPregunta"];
$textoPregunta=$_REQUEST["textoPregunta"];
$idTipoRespuesta=$_REQUEST["tipoRespuesta"];
$textoRespuesta[]=$_REQUEST["textoRespuesta"];
$pondRespuesta[]=$_REQUEST["ponderacion"];
$idProceso=$_SESSION["pk_proceso"];
$idEvidencia=$_SESSION["enc_idevidencia"];
require_once("../Modelo/ENC_preguntas_modelo.php");
$objPreguntas=new Preguntas();
$res=$objPreguntas->guardarModificaciones($idPregunta,$textoPregunta,$idTipoRespuesta,$textoRespuesta,$pondRespuesta,$idEvidencia,$idProceso,$institucional,$idGruposInteres);

require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_guardarModificacionPregunta_vista.php");
?>