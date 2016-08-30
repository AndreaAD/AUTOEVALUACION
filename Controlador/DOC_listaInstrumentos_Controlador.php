<?php


require_once('../Modelo/DOC_Selectores_Modelo.php');
$instancia  = new Selectores_Modelo;	

$grupos =  $instancia->cargarGrupoInteres();

require_once("../Vista/DOC_ListaInstrumentos_Vista.php");
?>