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
$id_pregunta = $_REQUEST["pk_pregunta"];
$tipo_proceso = $_REQUEST["tipo_proceso"];
$textoPregunta = $_REQUEST["textoPregunta"];
$grupo_interes = $_REQUEST["grupo_interes"];
$idTipoRespuesta = $_REQUEST["tipoRespuesta"];
$textoRespuesta[] = $_REQUEST["textoRespuesta"];
$pondRespuesta[] = $_REQUEST["ponderacion"];
$idProceso = $_SESSION["pk_proceso"];
$idEvidencia = $_SESSION["enc_idevidencia"];

require_once("../Modelo/ENC_preguntas_modelo.php");
foreach ($grupo_interes as $key => $value) {
    switch ($value) {
        case 1:
        case 2:
        case 4:
            $institucional = 0;
            break;
        default:
            $institucional = 1;
            break;
    }
}
$objPreguntas = new Preguntas();
if ($id_pregunta == '') {
    $id_pregunta = $objPreguntas->guardarPreguntaGenerica($textoPregunta, $idTipoRespuesta, $textoRespuesta, $pondRespuesta, $institucional);
}
foreach ($generico as $key => $value) {
    switch ($tipo_proceso) {
        case 1:
            $objPreguntas->guardarCaracteristicaPreguntaGenerica($id_pregunta, $value, $idProceso);

            break;
        case 2:
            $objPreguntas->guardarAspectoPreguntaGenerica($id_pregunta, $value, $idProceso);
            break;
    }
}
foreach ($grupo_interes as $key => $value) {
    $objPreguntas->guardarEnlaceUnaPreguntaGenerico($id_pregunta, $value, $idProceso, $institucional);
}
require_once("../Vista/elementos_vista.php");
$objComp = new Elementos();
require_once("../Vista/ENC_guardarModificacionPreguntaGenerica_vista.php");
?>