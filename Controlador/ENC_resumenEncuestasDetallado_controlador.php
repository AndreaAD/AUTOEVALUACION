<?php session_start();
if(isset($_REQUEST['idGrupo']) && isset($_SESSION["pk_proceso"])){
    require_once("../Modelo/ENC_encuesta_modelo.php");
    require_once("../Modelo/ENC_preguntas_modelo.php");
    require_once("../Modelo/ENC_gruposInteres_modelo.php");
    require_once("../Modelo/ENC_respuestas_modelo.php");
    require_once("../Modelo/ENC_consultas_modelo.php");
    $objConsultas=new Consultas();
    $idProceso=$_SESSION["pk_proceso"];
    $idGrupo=$_REQUEST['idGrupo'];
    $objEncuestas=new Encuesta();
    $objPreguntas=new Preguntas();
    $objGrupos=new GruposInteres();
    $objRespuestas=new Respuestas();
    $datosGrupo=$objGrupos->getUnGrupoInteres($idGrupo)->GetArray();
    $arrayColores=array('#F7464A','#46BFBD','#FDB45C','#949FB1','#4D5360','#e35360');
    if($idGrupo==1 || $idGrupo==2 || $idGrupo==4){
    $pkEncuesta=$objEncuestas->existeEncuesta($idProceso,$idGrupo);
    $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaGeneral($idProceso,$idGrupo,$pkEncuesta);
    }else if($idGrupo==3 || $idGrupo==5 || $idGrupo==6){
    $pkEncuesta=$objEncuestas->existeEncuestaInstitucional($idGrupo);
    $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($idGrupo,$pkEncuesta);
    }
    require_once("../Vista/elementos_vista.php");
    $objComp=new Elementos();
    require_once("../Vista/ENC_resumenEncuestasDetallado_vista.php");
}else{
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}?>