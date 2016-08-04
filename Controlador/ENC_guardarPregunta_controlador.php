<?php
session_start();
$institucional=0;
$idGruposInteres=array();
if(isset($_REQUEST["institucional"])){
    $institucional=$_REQUEST["institucional"];
    if(isset($_REQUEST["gruposInteres"])){
        $idGruposInteres[]=$_REQUEST["gruposInteres"];
    }
}
$textoPregunta=$_REQUEST["textoPregunta"];
$idTipoRespuesta=$_REQUEST["tipoRespuesta"];
$textoRespuesta[]=$_REQUEST["textoRespuesta"];
$pondRespuesta[]=$_REQUEST["ponderacion"];
//$idGruposInteres[]=$_REQUEST["gruposInteres"];
$idProceso=$_SESSION["pk_proceso"];
$idEvidencia=$_SESSION["enc_idevidencia"];
require_once("../Modelo/ENC_preguntas_modelo.php");
/*
echo "Pregunta: ".$textoPregunta;
echo "tipoRespuesta: ".$idTipoRespuesta;
echo "textoRespuesta: ";
print_r($textoRespuesta);
echo "Ponderacion respuesta: ";
print_r($pondRespuesta);
echo "Grupos interes: ";
print_r($idGruposInteres);*/
$objPreguntas=new Preguntas();
$res=$objPreguntas->guardarPregunta($textoPregunta,$idTipoRespuesta,$textoRespuesta,$pondRespuesta,$idEvidencia,$idProceso,$institucional,$idGruposInteres);

require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_guardarModificacionPregunta_vista.php");
?>