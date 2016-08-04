<?php
session_start();
$texto=$_REQUEST["texto"];
require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_ventanaEmergente_vista.php");
?>