<?php
//session_start();
//$_SESSION["pk_proceso"]=$_REQUEST["idProceso"];
//$idProceso=$_SESSION["pk_proceso"];
require_once("../Modelo/ENC_gruposInteres_modelo.php");
//require_once("../modelo/ENC_encuesta_modelo.php");
$objGruposInteres=new GruposInteres();
//$objEncuesta=new Encuesta();
$rsDatosGrupos=$objGruposInteres->getAllGrupos();
require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_publicarEncuesta_vista.php");
?>