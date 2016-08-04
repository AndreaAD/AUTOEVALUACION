<?php
session_start();
if(isset($_SESSION["pk_proceso"]) && isset($_SESSION["enc_idevidencia"])){
    // obtener id de proceso y evidencia que fueron seleccionados
    $idProceso=$_SESSION["pk_proceso"];
    $idEvidencia=$_SESSION["enc_idevidencia"];
    // obtener texto de factor, caracteristica, aspecto evidencia que fueron enviados desde la
    // pagina de seleccion de evidencia
    $txFactor=$_REQUEST["factor"];
    $txCaracteristica=$_REQUEST["caracteristica"];
    $txAspecto=$_REQUEST["aspecto"];
    $txEvidencia=$_REQUEST["evidencia"];
    // comprovar si el proceso y la evidencia no son nulos
    // si lo son devuelve a la parte de seleccion de evidencia
    if($idProceso!=null && $idEvidencia!=null){
        // se incluyen los modelos necesarios
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_gruposInteres_modelo.php");
        require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
        require_once("../Vista/elementos_vista.php");
        // objeto para manejar las preguntas
        $objPreguntas=new Preguntas();
        // solicitamos todas las perguntas normales que pertenecen a una evidencia
        $rsPreguntas=$objPreguntas->getAllPreguntasNormales($idEvidencia);
        // objeto para manejar lso grupos de interes
        $objGruposInt=new GruposInteres();
        // solicitamos todos los grupos de interes normales
        $rsDatosGrupos=$objGruposInt->getGruposEncuestasNormales();
        // convertimos el recordset de resultado a array para poder
        // recorrerlo mas de una ves mas adelante
        $arrayDatosGrupos=$rsDatosGrupos->GetArray();
        // obtenemos los grupos de interes para cada pregunta que trajimos
        // para saber que grupos estan habilitados en cada pregunta
        $rsGruposPreguntas=$objGruposInt->gruposInteresPreguntas($rsPreguntas,$idProceso);
        // objeto para manejar los tipos de respuesta
        $objTipoRes=new TiposRespuesta();
        // obtenemos la cantidad de respuestas
        //$rsCantidadRes=$objTipoRes->getCantidadRespuestas();
        // objeto para manejar las respuestas
        $objRespuestas=new Respuestas();
        // objeto para manejar los elementos de vista 
        $objComp=new Elementos();
        $faseProceso=$_SESSION['pk_fase'];
        require_once("../Vista/ENC_crearEncuesta_vista.php");
    }else{
        ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
    } 
}else{
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}
?>
