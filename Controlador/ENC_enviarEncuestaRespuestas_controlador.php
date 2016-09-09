<?php

require_once("../Modelo/ENC_encuesta_modelo.php");
$objEncuestas = new Encuesta();
if ($_REQUEST["metodo_encuesta"] == '') {
    if (isset($_REQUEST["sede"])) {
        $idSede = $_REQUEST["sede"];
    } else {
        $idSede = "";
    }
    if (isset($_REQUEST["programa"])) {
        $idPrograma = $_REQUEST["programa"];
    } else {
        $idPrograma = "''";
    }
    if (isset($_REQUEST["grupoInteres"])) {
        $idGrupoInteres = $_REQUEST["grupoInteres"];
    } else {
        $idGrupoInteres = "''";
    }
    if (isset($_REQUEST["idPregunta"])) {
        $idPreguntas = $_REQUEST["idPregunta"];
    } else {
        $idPreguntas = array();
    }
    if (isset($_REQUEST["alcance"])) {
        $alcandeAdmin = $_REQUEST["alcance"];
    } else {
        $alcandeAdmin = "''";
    }
    if (isset($_REQUEST["cargo"])) {
        $cargoDirectivo = $_REQUEST["cargo"];
    } else {
        $cargoDirectivo = "''";
    }
    if (isset($_REQUEST["idProceso"])) {
        $idProceso = $_REQUEST["idProceso"];
    } else {
        $idProceso = "''";
    }
    $idRespuestas = array();
    foreach ($idPreguntas as $id) {
        $idRespuestas[$id] = $_REQUEST["respuesta" . $id];
    }
    if (isset($_REQUEST['tipo'])) {
        $tipo = $_REQUEST['tipo'];
    } else {
        $tipo = -1;
    }
    if (isset($_REQUEST['programaFacultad'])) {
        $idProgramaFacultad = $_REQUEST['programaFacultad'];
    } else {
        $idProgramaFacultad = "''";
    }
    if (isset($_REQUEST['programas'])) {
        $listaProgramas = $_REQUEST['programas'];
    } else {
        $listaProgramas = array();
    }
    $resultado = $objEncuestas->guardarRespuestasEncuesta($idProceso, $idGrupoInteres, $idProgramaFacultad, $idPrograma, $idSede, $alcandeAdmin, $cargoDirectivo, $idPreguntas, $idRespuestas, $tipo, $listaProgramas);
    require_once("../Vista/elementos_vista.php");
    $objComp = new Elementos();
    require_once("../Vista/ENC_enviarEncuestaRespuestas_vista.php");
} else {
    $array_respuestas = array();
    $idGrupoInteres = $_POST['grupoInteres'];
    $subgrupo = $_POST['cargo'];

    $encuestas_activas = $objEncuestas->get_Encuestas_Activas($idGrupoInteres);
    foreach ($encuestas_activas as $key => $value) {
        $preguntas_encuesta[$value['pk_encuesta']] = $objEncuestas->get_Preguntas_Encuestas($value['pk_encuesta']);
        foreach ($preguntas_encuesta[$value['pk_encuesta']] as $key2 => $value2) {
            $objEncuestas->guardar_Respuestas_Encuestas($_POST['respuesta_encuesta_' . $value['pk_encuesta'] . '_' . $value2['pk_pregunta']]);
        }
    }
}
?>