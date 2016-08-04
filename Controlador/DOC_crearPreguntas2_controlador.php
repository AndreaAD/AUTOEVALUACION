<?php
session_start();

    $idProceso=$_SESSION["pk_proceso"];

    /**
     * validar si el proceso y evidencia actuial existen
     */
    if($idProceso!=null && $idEvidencia!=null){
        require_once("../Modelo/DOC_preguntas_modelo.php");
        require_once("../Modelo/DOC_tipoRespuesta_modelo.php");
        require_once("../Modelo/DOC_respuestas_modelo.php");
        $objTipoRes=new TiposRespuesta();
        $rsCantidadRes=$objTipoRes->getCantidadRespuestas();
        $objRespuestas=new Respuestas();
        require_once("../Vista/DOC_crearPreguntas2_vista.php");
    
?>