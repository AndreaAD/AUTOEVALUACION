<?php
session_start();
require_once("../Modelo/CNA_Proceso_Modelo.php");

$objProceso = new Proceso();
$listado_procesos_disponibles = $objProceso->Ver_Procesos();

$faseProceso=$_SESSION['pk_fase'];
require_once("../Vista/ENC_Listado_Procesos_Vista.php");
?>