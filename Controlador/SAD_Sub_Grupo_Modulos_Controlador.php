<?php

session_start();

require_once("../BaseDatos/AdoDB.php");   

$pk_modulo = $_GET['pk_modulo'];
$pk_grupo = $_GET['pk_grupo'];
$pk_sub_grupo = $_GET['pk_sub_grupo'];

require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");

require_once("../Vista/VIS_Elementos_Vista.php");

$objMod = new Grupo_Modulos();

$resSqlActGru = $objMod->Ver_Act_X_Gru($pk_modulo, $pk_grupo, $pk_sub_grupo);

$resSqlNomActGru = $objMod->Ver_Nom_Act_X_Gru($pk_modulo, $pk_grupo, $pk_sub_grupo);

require_once("../Vista/SAD_Sub_Grupo_Modulos_Vista.php");

?>