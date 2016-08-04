<?php
session_start();
$_SESSION["pk_proceso"]=9;
$_SESSION["pk_proceso_institucional"]=1;
$_SESSION["fase_proceso"]=1;
$_SESSION["enc_idfactor"]=null;
$_SESSION["enc_idcaracteristica"]=null;
$_SESSION["enc_idaspecto"]=null;
$_SESSION["enc_idevidencia"]=null;
require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_grupoEncuestas_vista.php");
?>