<?php

session_start();
$institucional = 0;
$idGruposInteres = array();
if (isset($_REQUEST["institucional"])) {
    $institucional = $_REQUEST["institucional"];
    if (isset($_REQUEST["gruposInteres"])) {
        $idGruposInteres[] = $_REQUEST["gruposInteres"];
    }
}
$generico = $_REQUEST['vista_check'];
$generico = explode(",", $generico);
foreach ($generico as $key => $value) {
    $i = $key + 1;
    while ($i <= sizeof($generico)) {
        if ($generico[$i] == $value) {
            unset($generico[$i], $generico[$key]);
            $i = sizeof($generico);
        }
        $i++;
    }
}


$textoPregunta = $_REQUEST["textoPregunta"];
$grupo_interes = $_REQUEST["grupo_interes"];
$idTipoRespuesta = $_REQUEST["tipoRespuesta"];
$textoRespuesta[] = $_REQUEST["textoRespuesta"];
$pondRespuesta[] = $_REQUEST["ponderacion"];
//$idGruposInteres[]=$_REQUEST["gruposInteres"];
$idProceso = $_SESSION["pk_proceso"];
$idEvidencia = $_SESSION["enc_idevidencia"];
require_once("../Modelo/ENC_preguntas_modelo.php");
//  echo "Pregunta: ".$textoPregunta;
//  echo "tipoRespuesta: ".$idTipoRespuesta;
//  echo "textoRespuesta: ";
//  print_r($textoRespuesta);
//  echo "Ponderacion respuesta: ";
//  print_r($pondRespuesta);
//  echo "Grupos interes: ";
//  print_r($idGruposInteres); die();
$objPreguntas = new Preguntas();
    $id_pregunta = $objPreguntas->guardarPreguntaGenerica($textoPregunta, $idTipoRespuesta, $textoRespuesta, $pondRespuesta, $idProceso, $institucional, $idGruposInteres);

foreach ($generico as $key => $value) {
        $objPreguntas->guardarEvidenciaPreguntaGenerica($id_pregunta, $value);

}
foreach ($grupo_interes as $key => $value) {
    $objPreguntas->guardarEnlaceUnaPreguntaGenerico($id_pregunta,$value,$idProceso);
}
require_once("../Vista/elementos_vista.php");
$objComp = new Elementos();
require_once("../Vista/ENC_guardarModificacionPreguntaGenerica_vista.php");
?>