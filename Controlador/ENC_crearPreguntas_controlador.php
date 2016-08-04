<?php
session_start();
// verificamos que exista la variable de sesion con la evidencia y el proceso 
// si no existen se devueleve a seleccion de evidencia
if(isset($_SESSION["pk_proceso"]) && isset($_SESSION["enc_idevidencia"])){
    // Extraer el pk de proceso y la evidencia que se selecciono de las variables de sesion
    $idProceso=$_SESSION["pk_proceso"];
    $idEvidencia=$_SESSION["enc_idevidencia"];
    // Extraemos los textos de factor, caracteristica, aspecto y evidencia
    // de la peticion http de la pagina anterior
    $txFactor=$_REQUEST["factor"];
    $txCaracteristica=$_REQUEST["caracteristica"];
    $txAspecto=$_REQUEST["aspecto"];
    $txEvidencia=$_REQUEST["evidencia"];
    // verificamos que el id del proceso y la evidencia no sea nulo
    if($idProceso!=null && $idEvidencia!=null){
        // incluimos los modelos
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
        // objeto para manejar las preguntas
        $objPreguntas=new Preguntas();
        // traer todas las preguntas normales, es decir las que no son institucionales
        $rsPreguntas=$objPreguntas->getAllPreguntasNormales($idEvidencia);
        // objeto para manejar el tipo de respues
        $objTipoRes=new TiposRespuesta();
        // traer la cantidad de espuestas
        $rsCantidadRes=$objTipoRes->getCantidadRespuestas();
        // objeto para manejar las respuestas
        $objRespuestas=new Respuestas(); 
        $faseProceso=$_SESSION['pk_fase'];
        require_once("../Vista/ENC_crearPreguntas_vista.php");
    }else{
        ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
    } 
}else{
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}
?>