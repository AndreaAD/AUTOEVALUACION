<?php session_start();
require_once("../Modelo/ENC_procesos_modelo.php");
$objProcesos=new Procesos();
$resultado=$objProcesos->copiarEnlacePreguntasProceos(1,9);
?>