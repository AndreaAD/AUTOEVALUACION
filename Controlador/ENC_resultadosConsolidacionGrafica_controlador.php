<?php session_start();
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
        require_once("../Modelo/ENC_consultas_modelo.php");
        require_once("../Modelo/ENC_gruposInteres_modelo.php");
        $objConsultas=new Consultas();
        //$objGrupos=new GruposInteres();
        $arrayColores=array('#F7464A','#46BFBD','#FDB45C','#949FB1','#4D5360','#e35360');
        $rsResultados=$objConsultas->getDatosInformeConsolidacionEvidencia($idEvidencia,$idProceso);
        $rsResultados=$rsResultados->GetArray();
        require_once("../Vista/elementos_vista.php");
        $objComp=new Elementos();
        require_once("../Vista/ENC_resultadosConsolidacionGrafica_vista.php");
    }else{
        ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
    } 
}else{
   ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}

?>