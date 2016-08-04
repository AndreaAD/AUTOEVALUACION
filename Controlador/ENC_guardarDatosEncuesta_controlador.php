<?php
session_start();
$opcion=$_REQUEST["opcion"];
if($opcion=="guardar"){    
    $idGrupoInteres=$_REQUEST["idGrupo"];
    $titulo=$_REQUEST["titulo"];
    $descripcion=$_REQUEST["descripcion"];
    $instrucciones=$_REQUEST["instrucciones"];
    require_once("../Modelo/ENC_encuesta_modelo.php");
    $objEncuestas=new Encuesta();
    $res=$objEncuestas->guardarDatosEncuesta($idGrupoInteres,$titulo,$descripcion,$instrucciones);
}
require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_guardarDatosEncuesta_vista.php");
?>