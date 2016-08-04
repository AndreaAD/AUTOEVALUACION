<?php session_start();
if(isset($_REQUEST['id'])){
    require_once("../Modelo/ENC_preguntas_modelo.php");
    require_once("../Modelo/ENC_respuestas_modelo.php");
    $idProceso=$_SESSION["pk_proceso"];
    //$idProcesoInstitucional=$_SESSION["pk_proceso_institucional"];
    $idEvidencia=$_SESSION["enc_idevidencia"];
    $objPreguntas=new Preguntas();
    $objRespuestas=new Respuestas();
    $rsPreguntas=$objPreguntas->getUnaPregunta($_REQUEST['id']);
    $rsRespuestas=$objRespuestas->getDatosRespuestas($_REQUEST['id']);
    require_once("../Vista/elementos_vista.php");
    $objComp=new Elementos();
    require_once("../Vista/ENC_eliminarDeshabilitarVentana_vista.php");
}else{
    if(isset($_SESSION["pk_proceso"]) && isset($_SESSION["enc_idevidencia"])){
        // Obtenemos el id del proceso, el id del proceso institucional y el id de la evidencia
        // de las variables de sesion
        $idProceso=$_SESSION["pk_proceso"];
        //$idProcesoInstitucional=$_SESSION["pk_proceso_institucional"];
        $idEvidencia=$_SESSION["enc_idevidencia"];
        // Obtenemos los textos de factor, caracteristica, aspecto y evidencia
        // enviados desde la pagina de seleccion de evidencia
        $txFactor=$_REQUEST["factor"];
        $txCaracteristica=$_REQUEST["caracteristica"];
        $txAspecto=$_REQUEST["aspecto"];
        $txEvidencia=$_REQUEST["evidencia"];
        if($idProceso!=null && $idEvidencia!=null){
            require_once("../Modelo/ENC_preguntas_modelo.php");
            require_once("../Modelo/ENC_respuestas_modelo.php");
            $objPreguntas=new Preguntas();
            $rsPreguntas=$objPreguntas->getAllPreguntas($idEvidencia);
            $objRespuestas=new Respuestas();
            require_once("../Vista/elementos_vista.php");
            $objComp=new Elementos();
            $faseProceso=$_SESSION['pk_fase'];
            require_once("../Vista/ENC_eliminarDeshabilitar_vista.php");
        }else{
            ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
        } 
    }else{
        ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
    }
}?>