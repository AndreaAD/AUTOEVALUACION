<?php
session_start();
$idProceso=$_REQUEST["idProceso"];
$idGrupoInteres=$_REQUEST["idGrupo"];
$txTitulo=$_REQUEST["titulo"];
$txDescripcion=$_REQUEST["descripcion"];
$txInstrucciones=$_REQUEST["instrucciones"];
require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Modelo/ENC_respuestas_modelo.php");
$objPreguntas=new Preguntas();
$objRespuestas=new Respuestas();
$rsDatosPreguntas=$objPreguntas->getPreguntasGrupoInteres($idProceso,$idGrupoInteres);
require_once("../Vista/ENC_preguntasPublicar_vista.php");
?>