<?php
require('../Modelo/CNA_Calendario_Modelo.php');
$mes=$_GET['month'];
$anio=$_GET['year'];
$nombre=$_GET['nombre'];
$dia=1; 
calendar($mes,$anio,$nombre);
?>