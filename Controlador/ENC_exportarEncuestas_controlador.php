<?php session_start();
    if(isset($_REQUEST['idGrupo']) && isset($_REQUEST['idProceso'])){
        require_once("../Modelo/ENC_encuesta_modelo.php");
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_gruposInteres_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
        $idProceso=$_REQUEST['idProceso'];
        $idGrupo=$_REQUEST['idGrupo'];
        $objEncuestas=new Encuesta();
        $objPreguntas=new Preguntas();
        $objGrupos=new GruposInteres();
        $objRespuestas=new Respuestas();
        $rsGrupoInteres=$objGrupos->getUnGrupoInteres($idGrupo);
        $rsDatosEncuesta=$objEncuestas->getDatosEncuesta($idGrupo);
        if($idGrupo==1 || $idGrupo==2 || $idGrupo==4){
            $pkEncuesta=$objEncuestas->existeEncuesta($idProceso,$idGrupo);
            $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaGeneral($idProceso,$idGrupo,$pkEncuesta);
        }else if($idGrupo==3 || $idGrupo==5 || $idGrupo==6){
            $pkEncuesta=$objEncuestas->existeEncuestaInstitucional($idGrupo);
            $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($idGrupo,$pkEncuesta);
        }
        require_once("../Vista/ENC_generarEncuestaPdf_vista.php");
    }else{
        require_once("../Modelo/ENC_gruposInteres_modelo.php");
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Modelo/ENC_encuesta_modelo.php");
        $objGruposInteres=new GruposInteres();
        $idProceso=$_SESSION["pk_proceso"];
        $rsGruposInteres=$objGruposInteres->getAllGrupos();
        require_once("../Vista/elementos_vista.php");
        $objComp=new Elementos();
        $faseProceso=$_SESSION['pk_fase'];
        require_once("../Vista/ENC_exportarEncuestas_vista.php");
    }
?>