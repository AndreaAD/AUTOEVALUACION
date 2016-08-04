<?php session_start();
if(isset($_SESSION["pk_proceso"])){
    $idProceso=$_SESSION["pk_proceso"];
    require_once("../Modelo/ENC_gruposInteres_modelo.php");
    require_once("../Modelo/ENC_consultas_modelo.php");
    $objGrupoInteres=new GruposInteres();
    $objConsultas=new Consultas(); 
    $rsGrupos=$objGrupoInteres->getAllGrupos();
    $rsGrupos=$rsGrupos!=null ? $rsGrupos->GetArray() : false;
    require_once("../Vista/elementos_vista.php");
    $objComp=new Elementos();
    $faseProceso=$_SESSION['pk_fase'];
    require_once("../Vista/ENC_resumenEncuestas_vista.php");
}else{
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}
?>