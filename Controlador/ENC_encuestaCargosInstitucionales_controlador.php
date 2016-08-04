<?php
session_start();
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
    // verificamos que el id de proceso no sea nulo y tampoco la evidencia
    if($idProceso!=null && $idEvidencia!=null){
        // incluimos los modelos necesarios para el proceso
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_gruposInteres_modelo.php");
        require_once("../Modelo/ENC_gruposInteresPreguntas_modelo.php");
        require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
        require_once("../Modelo/ENC_procesos_modelo.php");
        // creamos el objeto de la clase preguntas
        $objPreguntas=new Preguntas();
        // traemos todas las preguntas pero solo las de tipo institucinal que pertenecen
        // a la evidencia seleccionada
        $rsPreguntas=$objPreguntas->getAllPreguntasInstitucionales($idEvidencia);
        // creamos el objeto de la clase grupos de interes
        $objGruposInt=new GruposInteres();
        // traemos los grupos de interes que son institucionales
        $rsDatosGrupos=$objGruposInt->getGruposEncuestasInstitucionales();
        // transformamos de recordset a array el resultado de grupos de interes
        // para poder recorrerlo mas de una ves
        $arrayDatosGrupos=$rsDatosGrupos->GetArray();
        $objProcesos=new Procesos();
        $idProcesoInstitucional=$objProcesos->getPkProcesoInstitucional($idProceso);
        // traemos los grupos de interes para cada pregunta
        $rsGruposPreguntas=$objGruposInt->gruposInteresPreguntasInstitucionales($rsPreguntas,$idProcesoInstitucional);
        // creamos el objeto de tipo respuesta
        $objTipoRes=new TiposRespuesta();
        // traemos un listado de la cantidad de respuestas ordenadas de menor a mayor
        $rsCantidadRes=$objTipoRes->getCantidadRespuestas();
        // creamos el objeto para controlas las respuestas
        $objRespuestas=new Respuestas();
        require_once("../Vista/elementos_vista.php");
        $objComp=new Elementos();
        $faseProceso=$_SESSION['pk_fase'];
        require_once("../Vista/ENC_encuestaCargosInstitucionales_vista.php");
    }else{
       ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
    } 
}else{
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}
?>