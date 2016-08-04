<?php session_start();
if(isset($_SESSION["pk_proceso"]) && isset($_SESSION["enc_idevidencia"])){
    $idProceso=$_SESSION["pk_proceso"];
    $idEvidencia=$_SESSION["enc_idevidencia"];
    $idGrupo=$_REQUEST['idGrupo'];
    //var_dump($idProceso);
    //var_dump($idEvidencia);
    //var_dump($idGrupo);
    require_once("../Modelo/ENC_preguntas_modelo.php");
    require_once("../Modelo/ENC_respuestas_modelo.php");
    require_once("../Modelo/ENC_gruposInteres_modelo.php");
    require_once("../Modelo/ENC_consultas_modelo.php");
    $objPreguntas=new Preguntas();
    $objRespuestas=new Respuestas();
    $objGrupoInteres=new GruposInteres();
    $objConsultas=new Consultas();
    $arrayColores=array('#F7464A','#46BFBD','#FDB45C','#949FB1','#4D5360','#e35360');
    $datosGrupo=$objGrupoInteres->getUnGrupoInteres($idGrupo)->GetArray();
    $rsPreguntas=$objPreguntas->getPreguntasEvidenciaProceso($idProceso,$idGrupo,$idEvidencia);
    $rsPreguntas=$rsPreguntas!=null ? $rsPreguntas->GetArray() : false;
    require_once("../Vista/elementos_vista.php");
    $objComp=new Elementos();
    require_once("../Vista/ENC_informeDetallado_vista.php");
}
?>