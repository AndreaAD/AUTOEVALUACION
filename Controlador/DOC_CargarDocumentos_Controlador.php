<?php
session_start();

//require_once('../Modelo/DOC_Autoevaluacion_Modelo.php');
//$instancia  = new Autoevaluacion_Modelo;
//$usuario =  $instancia->consultaUsuario($_SESSION['array_proceso']);
//$usuario_alcance =  $instancia->consultaUsuarioAlcance($_SESSION['pk_rol'], $_SESSION['pk_usuario'] );
//$insertar_ins =  $instancia->insertarInstrumentosProceso($_SESSION['array_proceso']);
//var_dump($usuario);

require_once("../Vista/DOC_CargaDocumentos_Vista.php");
?>