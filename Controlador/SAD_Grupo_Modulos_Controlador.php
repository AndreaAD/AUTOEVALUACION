<?php

session_start();

require_once("../BaseDatos/AdoDB.php");   

require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");

require_once("../Vista/VIS_Elementos_Vista.php");

$pk_modulo = $_GET['pk_modulo'];
$pk_grupo = $_GET['pk_grupo'];
$pk_sub_grupo = $_GET['pk_sub_grupo'];

$objMod = new Grupo_Modulos();

$resSqlSubGru = $objMod->Ver_Sub_X_Gru($pk_modulo, $pk_grupo);

$resSqlSubGruComprar = $objMod->Ver_Sub_X_Gru($pk_modulo, $pk_grupo);

$resSqlNomSubGru = $objMod->Ver_Nom_Sub_X_Gru($pk_modulo, $pk_grupo);

$resSqlActGru = $objMod->Ver_Act_X_Gru($pk_modulo, $pk_grupo, $pk_sub_grupo);

$resSqlNomActGru = $objMod->Ver_Nom_Act_X_Gru($pk_modulo, $pk_grupo, $pk_sub_grupo);

require_once("../Vista/SAD_Grupo_Modulos_Vista.php");

?>